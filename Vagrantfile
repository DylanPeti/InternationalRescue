# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

    # Hostname
    config.vm.hostname = "local.internationalrescue.dev"

    # Box nam
    config.vm.box = "deb72"

    # Apache
    config.vm.network :forwarded_port, guest: 80, host: 5010
    # Mysql
    config.vm.network :forwarded_port, guest: 3306, host: 3306

    # Careful not to create IP conflict in the network
    config.vm.network :private_network, ip: "192.168.88.10"

    # If application need public access
    # config.vm.network :public_network, ip: "192.168.0.199"

    config.vm.synced_folder ".", "/vagrant", :nfs => true

    config.ssh.forward_agent = true

    # Host manager
    config.hostmanager.enabled = true
    config.hostmanager.manage_host = true
    config.hostmanager.ignore_private_ip = false
    config.hostmanager.include_offline = true
    config.hostmanager.aliases = %w(local.ir.dev)

    # VMware...
    # config.vm.provider "vmware_fusion" do |v|
        # v.gui = true
        # v.vmx["memsize"] = "1024"
        # v.vmx["numvcpus"] = "2"
    # end

    # ... or Virtual Box
    # config.vm.provider :virtualbox do |vb|
        # vb.gui = true

        # Workaround VM booting because of ssh login https://github.com/mitchellh/vagrant/issues/391
        # vb.customize ["modifyvm", :id, "--rtcuseutc", "on"]
        # vb.customize ["modifyvm", :id, "--memory", "2048"]
    # end

    # Omnibus plugin: update chef version
    config.omnibus.chef_version = :latest

    # Chef provision
    config.vm.provision :chef_solo do |chef|
        chef.log_level = :debug

        # chef.roles_path = "../my-recipes/roles"
        # chef.add_role "web"
        # chef.data_bags_path = "chef/data_bags"
        chef.cookbooks_path = [ "chef/cookbooks/vendor", "chef/cookbooks/custom" ]
    
        chef.add_recipe "build-essential"
        chef.add_recipe "apt"
        chef.add_recipe "xml"
        chef.add_recipe "vim"
        chef.add_recipe "git"
        chef.add_recipe "mysql::server"
        chef.add_recipe "database::mysql"
        chef.add_recipe "php"
        chef.add_recipe "php::module_apc"
        chef.add_recipe "php::module_gd"
        chef.add_recipe "php::module_curl"
        chef.add_recipe "php::module_mysql"
        chef.add_recipe "apache2"
        chef.add_recipe "apache2::mod_php5"
        chef.add_recipe "apache2::mod_rewrite"
        chef.add_recipe "nodejs"

        chef.add_recipe "utils"
        chef.add_recipe "dev"
        chef.add_recipe "lamp"

        chef.json = {
            :utils => {
                :timezone => "Etc/UTC",
            },
            :lamp  => {
                :env    => "dev",
                :url    => config.vm.hostname,
                :vhosts => {
                    :server_aliases => config.hostmanager.aliases,
                    :docroot        => "/vagrant",
                    :log_level      => "debug",
                },
                :databases => {
                    :mysql_name       => "ir",
                    :mysql_user       => "ir",
                    :mysql_pass       => "ir",
                    :mysql_host       => "localhost",
                    :mysql_privileges =>  %w[SELECT INSERT UPDATE DELETE CREATE ALTER DROP],
                    :mysql_sql_file   => ""
                }
            },
            :build_essential => {
                :compiletime => true
            },
            :apache => {
                :user  => "vagrant",
                :group => "vagrant"
            },
            :php => {
                :install_method => "package"
            },
            :mysql => {
                :server_debian_password => "root",
                :server_root_password   => "root",
                :server_repl_password   => "root",
            }
        }
    end
end