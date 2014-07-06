#
# Cookbook Name:: utils
# Recipe:: default

# Change local time
execute "timezone update" do
  command "echo \"#{node['utils']['timezone']}\" | tee /etc/timezone && dpkg-reconfigure --frontend noninteractive tzdata"
  user "root"
end


# Curl
%w[curl libcurl3 libcurl3-dev].each do |package_name|
  package package_name do
    action :install
  end
end

# System utils
%w[ack-grep htop iotop mytop].each do |package_name|
  package package_name do
    action :install
  end
end