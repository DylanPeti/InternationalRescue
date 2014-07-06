#
# Cookbook Name:: lamp
# Recipe:: databases

# Connection
mysql_connection_info = {
  :host     => node['lamp']['databases']['mysql_host'],
  :username => 'root',
  :password => node['mysql']['server_root_password']
}

# Create database
mysql_database node['lamp']['databases']['mysql_name'] do
  connection mysql_connection_info
  action :create
end

# Create user
mysql_database_user node['lamp']['databases']['mysql_user'] do
  connection mysql_connection_info
  password   node['lamp']['databases']['mysql_pass']
  action     :create
end

# Grant privileges
mysql_database_user node['lamp']['databases']['mysql_user'] do
  connection    mysql_connection_info
  database_name node['lamp']['databases']['mysql_name']
  privileges    node['lamp']['databases']['mysql_privileges']
  action        :grant
end


# Import database from a sql script, quicker than the lwrp
if ::File.exists?(node['lamp']['databases']['mysql_sql_file'])
  execute "import sql data" do
    command "mysql -u root -p#{node['mysql']['server_root_password']} #{node['lamp']['databases']['mysql_name']} < #{node['lamp']['databases']['mysql_sql_file']}"
  end
end
