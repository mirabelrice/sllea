set :stage, :staging
set :stage_domain, "dev.sllea.org"
server "sllea@sllea.org", roles: %w{web app db}, user: "sllea"
set :port, 2222
set :deploy_to, "/home3/sllea/public_html"

set :branch, "development"