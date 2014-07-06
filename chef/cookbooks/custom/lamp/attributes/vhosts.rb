#
# Cookbook Name:: lamp
# Attributes:: vhosts

# Virtual hosts attributes
default['lamp']['vhosts']['server_aliases'] = ["lamp.local"]
default['lamp']['vhosts']['docroot'] = "/vagrant"
default['lamp']['vhosts']['directory_index'] = "index.php"
default['lamp']['vhosts']['directory_options'] = %w{Indexes MultiViews FollowSymLinks}
default['lamp']['vhosts']['allow_override'] = %w{All}
default['lamp']['vhosts']['log_level'] = "debug"