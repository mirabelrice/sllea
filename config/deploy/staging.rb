set :stage, :staging
set :stage_domain, "dev.sllea.org"
server "sllea@108.167.183.235", roles: %w{web app db}, port: 2222
set :deploy_to, "/home3/sllea/public_html/dev"

set :branch, "development"