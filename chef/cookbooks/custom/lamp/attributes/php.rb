#
# Cookbook Name:: lamp
# Attributes:: php

# php apt packages
default['lamp']['php']['packages'] = %w[php5-imagick php5-mcrypt]
default['lamp']['php']['dev_packages'] = %w[php5-xdebug]