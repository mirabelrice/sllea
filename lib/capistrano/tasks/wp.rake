namespace :wp do
  task :set_permissions do
    on roles(:web) do
      execute :chmod, "-R 755 #{shared_path}/content/uploads"
      puts "set permissions for shared uploads directory"
    end
  end

  namespace :setup do
    desc "Generates files and symlinks on remote server"
    task :generate_remote_files do
      on roles(:web) do
      execute :mkdir, "-p #{shared_path}"

      # Setup Variables
      wp_env       = fetch(:stage)
      wp_debug     = false
      wp_domain    = fetch(:stage_domain)
      project_path = fetch(:deploy_to) + '/current'

      # Get database credentials
      database = YAML::load_file('config/database.yml')[fetch(:stage).to_s]

      # Generate new salt
      secret_keys  = capture("curl -s -k https://api.wordpress.org/secret-key/1.1/salt")

      # Create config file in remote environment
      db_config = ERB.new(File.read('config/templates/wp-config.php.erb')).result(binding)
      io = StringIO.new(db_config)
      upload! io, File.join(shared_path, "wp-config.php")

      invoke 'wp:setup:generate_security_keys'
      invoke 'wp:setup:create_upload_dir'
      end
    end

    desc "Update the WordPress DB version when the core files are also updated"
    task :update_db do
      on roles(:web) do |server|
        within release_path do
          sites = JSON.parse(capture(:wp, "site list --fields=blog_id,deleted --format=json"))
          sites.each do |site|

            # Skip sites which are deleted
            next if (site['deleted'] == '1')

            # Get the site URL
            site_url = capture(:wp, "site url #{site['blog_id']}")

            # Update the RSS option
            execute :wp, "core update-db --url=#{site_url}"

            info "Updating DB for #{site_url}"

          end
        end
      end
    end

    desc "Create or update the WP Security Keys"
    task :generate_security_keys do
      on roles(:web) do

        # Fetch new keys
       secret_keys = "<?php \n\n" + `curl -s -k https://api.wordpress.org/secret-key/1.1/salt`

        # Write to disk
        io = StringIO.new(secret_keys)
        upload! io, File.join(shared_path, "wp-security-keys.php")

        # Done!
        puts "The WP Security Keys have been changed. Existing user sessions have been invalidated and users must log in again on #{fetch(:stage_domain)}."

      end
    end

    desc "Creates the uploads folder(unless it exists already exists) in shared dir"
    task :create_upload_dir do
      on roles(:web) do
        upload_dir = File.join(shared_path, 'uploads')
        if Dir.exist?(upload_dir).nil?
            execute :mkdir, upload_dir
            puts "created remote upload directory in /public_html/shared/content/"
        end
      end
    end

    desc "Setup WP on remote environment"
    task :remote do
      invoke 'wp:setup:generate_remote_files'
      invoke 'deploy'
      invoke 'wp:set_permissions'
    end

  end

end