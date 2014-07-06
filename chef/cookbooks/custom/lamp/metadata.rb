name             'lamp'
maintainer       'Alix Chaysinh'
maintainer_email 'alix.chaysinh@gmail.com'
license          'All rights reserved'
description      'Installs/Configures LAMP'
long_description IO.read(File.join(File.dirname(__FILE__), 'README.md'))
version          '0.3'
recipe           'lamp::default', 'Set up LAMP for application'
recipe           'lamp::vhosts', 'Set up the virtual hosts for the application'
recipe           'lamp::mysql', 'Set up the mysql database for the application'
recipe           'lamp::php', 'Set up the mysql database for the application'

%w{ ubuntu debian }.each do |os|
  supports os
end
