desc "Starts development server and open Browser"
task :serve => 'setup:ensure_config_exists' do

  config = YAML::load_file('config/config.yml')
  # open browser
  system "open http://#{config['development_url']}"

  # Start php server
  exec "php -S #{config['development_url']} -t public_html/ lib/router.php"

end