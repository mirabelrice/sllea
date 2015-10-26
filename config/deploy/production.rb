set :stage, :production
set :stage_domain, "sllea.org"
server "sllea@108.167.183.235", roles: %w{web}, port: 2222
set :deploy_to, "/home3/sllea/public_html"
set :branch, "master"
