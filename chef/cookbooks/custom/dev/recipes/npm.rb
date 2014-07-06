#
# Cookbook Name:: dev
# Recipe:: npm

include_recipe "npm"

node['dev']['npm']['packages'].each do |npm_package_name|
    npm_package npm_package_name do
        action :install
    end
end