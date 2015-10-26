#wordpress setup
config = YAML::load_file('./config/config.yml')
set :local_domain, config['development_url']
#sllea setup
set :application, "sllea"
set :repo_url, 'git@github.com:mirabelrice/sllea.git'
set :scm, :git
set :tmp_dir, "#{fetch(:stage)}/tmp"

#Capistrano setup
set :format, :pretty
set :log_level, :debug
set :pty, true
set :ssh_options, {
  forward_agent: true
}
set :keep_releases, 5

Dir.glob('lib/capistrano/tasks/*.rake').each { |r| import r }

#linked files and directories
set :linked_files, %w{wp-config.php}
set :linked_dirs, %w{wp-content/uploads}

namespace :deploy do
	#wp files task
	desc "Create WP Files"
	task :create_wp_files do
		on roles(:app) do
			execute :touch, "#{shared_path}/wp-config.php"
		end
	end

	after 'check:make_linked_dirs', :create_wp_files

	after :finished, 'prompt:complete' do
		print_sucess("deployment to #{fetch(:stage_domain)} complete.")
	end
end
