namespace :db do
  desc "Creates a sensible backup name for SQL files"
  task :backup_name do
    on roles(:web) do
      execute :mkdir, "-p #{shared_path}/db_backups"
      set :backup_filename, backup_timestamp
      set :backup_file, "#{shared_path}/db_backups/#{fetch(:backup_filename)}.sql"
    end
  end

  desc "Takes a database dump from remote server"
  task :backup do
   invoke 'db:backup_name'
    on roles(:db) do
      within release_path do
        execute :wp, "db export #{fetch(:backup_file)} --add-drop-table"
      end

      system('mkdir -p db_backups')
      download! "#{fetch(:backup_file)}", "db_backups/#{fetch(:stage)}__#{fetch(:backup_filename)}.sql"

      within release_path do
        execute :rm, "#{fetch(:backup_file)}"
      end

    end
  end

  desc "Imports the remote database into your local environment"
  task :pull do
    invoke 'db:backup'
    on roles(:db) do
      run_locally do

        # Import DB
        execute :wp, "db import db_backups/#{fetch(:stage)}__#{fetch(:backup_filename)}.sql"

        # Replace domain name
        sleep 2
        execute :wp, "search-replace --network --recurse-objects --url=#{fetch(:stage_domain)} --skip-columns=guid #{fetch(:stage_domain)} #{fetch(:local_domain)}"

        # Replace protocol
        sleep 2
        execute :wp, "search-replace --network --recurse-objects --url=#{fetch(:local_domain)} --skip-columns=guid https://#{fetch(:local_domain)} http://#{fetch(:local_domain)}"

      end

    end

  end
end