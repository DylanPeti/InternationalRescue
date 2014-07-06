#
# Cookbook Name:: lamp
# Attributes:: databases

# Database dsn
default['lamp']['databases']['mysql_name'] = 'lamp'
default['lamp']['databases']['mysql_user'] = 'lamp'
default['lamp']['databases']['mysql_pass'] = 'lamp'
default['lamp']['databases']['mysql_host'] = 'localhost'

default['lamp']['databases']['mysql_privileges'] =  %w[SELECT INSERT UPDATE DELETE CREATE ALTER DROP]
default['lamp']['databases']['mysql_sql_file'] = ''