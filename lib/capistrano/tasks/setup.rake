# encoding: utf-8
namespace :setup do
	config = YAML::load_file('config/config.yml')

  desc "Create wp-config.php"
  task :wp_config do
    # Setup Variables
    wp_env         = 'development'
    wp_domain      = config['development_url']
    project_path   = Dir.pwd
    protocol       = 'http://'

    # Generate new salt
    secret_keys = `curl -s -k https://api.wordpress.org/secret-key/1.1/salt`

    # Get database credentials
    database = Hash.new
    database = YAML::load_file('config/database.yml')['local']

    # Create wp-config.php
    db_config = ERB.new(File.read('config/templates/wp-config-development.php.erb')).result(binding)
    File.open("wp-config.php", 'w') {|f| f.write(db_config) }

    puts('Created wp-config.php in your local environment')
  end

  desc "Create or update the WP Security Keys"
  task :generate_security_keys do
    secret_keys = "<?php \n\n" +  `curl -s -k https://api.wordpress.org/secret-key/1.1/salt`
    File.open("wp-security-keys.php", 'w') {|f| f.write(secret_keys) }
    puts "The WP Security Keys have been changed. Existing user sessions have been invalidated and users must log in again."
  end

  desc "Ensure wp-config.php exists"
  task :ensure_config_exists do
    if File.size?('wp-config.php').nil?
      Rake::Task["setup"].invoke
    else
      puts('wp-config.php already exists.')
    end
  end
end

desc "Create all local config files"
task :setup => ["setup:wp_config"]

desc "Create all local security keys"
task :security => ["setup:generate_security_keys"]