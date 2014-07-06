Singularity
============
[Singularity](https://github.com/Team-Sass/Singularity) is a next generation grid framework built from the ground up to be responsive. 

Installation
------------
```
cd ~/.compass/extensions
git clone https://github.com/Team-Sass/breakpoint.git breakpoint
cd breakpoint
git checkout tags/v2.0.6

cd ~/.compass/extensions
git clone https://github.com/Team-Sass/Singularity.git singularitygs
cd singularitygs
git checkout tags/v1.1.2
```


vagrant-chef
============

Vagrant with chef provisioning.
LAMP version for Debian 7 aka Wheezy.

Requirements
------------
- Ruby

- [Vagrant](http://www.vagrantup.com/downloads.html)

  - with plugin vagrant-vbox-snapshot which is awesome for testing provisions
    ```
    vagrant plugin install vagrant-vbox-snapshot
    ```

  - with plugin vagrant-omnibus to install chef to the most recent version
    ```
    vagrant plugin install vagrant-omnibus
    ```

  - with plugin vagrant-berkshelf to install Berkshelf for recipes dependencies
    ```
    vagrant plugin install vagrant-berkshelf
    ```

  - with plugin vagrant-cachier to speed up vagrant
    ```
    vagrant plugin install vagrant-cachier
    ```

- [Chef Solo](http://docs.opscode.com/install_omnibus.html)

- [Berkshelf](http://berkshelf.com/)


Installation
------------

```
berks install -p chef/cookbooks/vendor
vagrant up
```