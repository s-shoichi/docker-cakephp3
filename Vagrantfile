# -*- coding: utf-8 -*-
# -*- mode: ruby -*-
# vi: set ft=ruby :
VAGRANTFILE_API_VERSION = "2"
%w[vagrant-hostmanager vagrant-docker-compose].each do |plugin_name|
  unless Vagrant.has_plugin?(plugin_name)
    raise "#{plugin_name}プラグインが見つかりません。 インストールしてください `vagrant plugin install #{plugin_name}`"
  end
end

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.ssh.insert_key = false
  config.vm.box = "coreos-alpha"
  config.vm.box_url = "https://storage.googleapis.com/alpha.release.core-os.net/amd64-usr/current/coreos_production_vagrant.json"

  config.vm.network :private_network, ip: "192.168.33.20"
  config.vm.hostname = 'docker.cakephp'
  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true

  Encoding.default_external = 'UTF-8'

  # vagrant-vbguestプラグインが入っている場合、自動更新を無効にする
  if Vagrant.has_plugin?("vagrant-vbguest") then
    config.vbguest.auto_update = false
    config.vbguest.no_remote = true
  end

  config.vm.provision "shell", inline: 'sudo timedatectl set-timezone Asia/Tokyo'
  config.vm.provision "shell", inline: 'sudo mkdir -p /opt/bin'
  config.vm.provision :docker
  config.vm.provision :docker_compose,
                      executable_install_path: "/opt/bin/docker-compose-org",
                      executable_symlink_path: "/opt/bin/docker-compose", 
                      yml: "/home/core/share/docker/docker-compose.yml", run: "always"

  config.vm.provider "virtualbox" do |vb|
    vb.check_guest_additions = false
    vb.functional_vboxsf     = false
    vb.memory = "2048"
  end

  if Vagrant.has_plugin?("vagrant-winnfsd") then
    config.winnfsd.uid = 500
    config.winnfsd.gid = 500
  end
  config.vm.synced_folder ".", "/home/core/share", :nfs => true,  :mount_options   => ['nolock,vers=3,udp']

end
