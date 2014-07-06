#
# Cookbook Name:: lamp
# Recipe:: php


# Install php apt packages
node['lamp']['php']['packages'].each do |package_name|
  package package_name do
    action :install
  end
end

# Install php dev apt packages
if node['lamp']['env'] == "dev"
  node['lamp']['php']['dev_packages'].each do |package_name|
    package package_name do
      action :install
    end
  end

  template "/etc/php5/conf.d/20-xdebug.ini" do
    owner  "root"
    group  "root"
    mode   0644
    source "php/xdebug.ini.erb"
  end

end

# Restart apache
execute "vhost restart apache" do
  command "service apache2 restart"
  user    "root"
end