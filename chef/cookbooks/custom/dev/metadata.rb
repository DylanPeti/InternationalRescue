name             'utils'
maintainer       'Alix Chaysinh'
maintainer_email 'alix.chaysinh@gmail.com'
license          'All rights reserved'
description      'Installs/Configures LAMP'
long_description IO.read(File.join(File.dirname(__FILE__), 'README.md'))
version          "0.2"
recipe           "lamp::default", "Set up default utils"

%w{ ubuntu debian }.each do |os|
  supports os
end
