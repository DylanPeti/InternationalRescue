#
# Cookbook Name:: lamp
# Recipe:: default
#
# Copyright (C) 2014 Alix Chaysinh
# 
# All rights reserved - Do Not Redistribute
#

include_recipe "lamp::mysql"
include_recipe "lamp::php"
include_recipe "lamp::vhosts"