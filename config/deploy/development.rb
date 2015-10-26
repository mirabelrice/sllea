set :stage, :development
set :stage_domain, "sllea.local"
server "localhost", roles: [:web], user: "root"
set :port, 8888