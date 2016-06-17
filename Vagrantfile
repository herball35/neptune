# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
  config.vm.box = "debian/jessie64"
  config.vm.box_check_update = true

  config.vm.network :forwarded_port, host: 8798, guest: 80
  config.vm.network :forwarded_port, guest: 22, host: 2222, id: "ssh", disabled: true
  config.vm.network :forwarded_port, guest: 22, host: 2798, auto_correct: true

  config.vm.synced_folder "./", "/vagrant", id: "vagrant-root",
    owner: "vagrant",
    group: "vagrant",
    mount_options: ["dmode=777,fmode=777"]


  # if RSYNC enabled
  config.vm.synced_folder "./", "/var/www/neptune", type: "rsync", owner: "vagrant", group: "vagrant",
    rsync__exclude: [".git/", ".idea/", "app/cache", "app/logs", "vendor/", "build/", "web/js", "web/images", "web/css"],
    rsync__chown: true,
    rsync__auto: true,
    rsync_args: ["--verbose", "--delete", "--progress", "--perms", "--chmod=ugo=rwxs"]

  config.vm.provider "virtualbox" do |v|
    v.customize ["modifyvm", :id, "--memory", "1536"]
    v.customize ["modifyvm", :id, "--ioapic", "on"]
    v.customize ["modifyvm", :id, "--cpus", "1"]
  end

  config.vm.provision "shell", path: "provision/provision.sh"

  #TODO
  #netsh interface portproxy add v4tov4 listenport=80 listenaddress=neptune.local connectport=8798 connectaddress=127.0.0.1
end
