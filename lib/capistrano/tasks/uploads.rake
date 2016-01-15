namespace :uploads do
	desc "Creates the uploads folders(unless it exists already exists)"
	task :setup do
		on roles(:web) do
			dirs = linked_dirs.map { |d| File.join(shared_path, d) }
			execute "#{try_sudo} mkdir -p #{dirs.join(' ')} && #{try_sudo} chmod g+w #{dirs.join(' ')}"
	 	end
	end

	desc "[internal] Creates the symlink to uploads shared folder for the most recently deployed version."
	task :symlink do
		on roles(:web) do
			project_path = fetch(:deploy_to) + '/current'
			execute :mkdir, "-p #{shared_path}/content/uploads"
			execute "rm -rf #{project_path}/uploads"
			execute "ln -s #{shared_path}/uploads #{project_path}/content/uploads"
		end
	end

	desc "[internal] Computes uploads directory paths and registers them in Capistrano environment."
	task :register_dirs do
		on roles(:web) do
			set :uploads_dirs, %w(uploads uploads/partners)
			set :linked_files, fetch(:linked_files) + fetch(:linked_dirs)
		end
	end

	desc "Setup uploads dir on remote environment"
    task :remote do
    	invoke 'uploads:setup'
        invoke 'uploads:symlink'
	    invoke 'uploads:register_dirs'

    end
end