set :stage, :production
set :stage_domain, "sllea.org"
server "sllea@sllea.org", roles: [:web], user: "sllea"
set :port, 2222
set :deploy_to, "/home3/sllea/public_html"

set :branch, "master"