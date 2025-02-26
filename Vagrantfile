Vagrant.configure("2") do |config|

   # we will try to autodetect this path. 
  # However, if we cannot or you have a special one you may pass it like:
  # config.vbguest.iso_path = "#{ENV['HOME']}/Downloads/VBoxGuestAdditions.iso"
  # or an URL:
  config.vbguest.iso_path = "https://download.virtualbox.org/virtualbox/7.1.4/VBoxGuestAdditions_7.1.4.iso"
  # or relative to the Vagrantfile:
  # config.vbguest.iso_path = "../relative/path/to/VBoxGuestAdditions.iso"
  
  # set auto_update to false, if you do NOT want to check the correct 
  # additions version when booting this machine
  config.vbguest.auto_update = false
  
  # do NOT download the iso file from a webserver
  config.vbguest.no_remote = false
  # Definindo variáveis de configuração
  IP = "192.168.56.100"
  MEM = 2048
  CPU = 2

  # Configuração da box e rede
  config.vm.box = "almalinux/9"
  config.vm.network "private_network", ip: IP
  
  # Redirecionamento de portas conforme o arquivo docker-compose
  config.vm.network "forwarded_port", guest: 3306, host: 13306  # Banco de dados MariaDB
  config.vm.network "forwarded_port", guest: 8080, host: 10180 # Admin

  # Configuração de recursos da VM
  config.vm.provider "virtualbox" do |vb|
    vb.memory = MEM
    vb.cpus = CPU
  end

  # Desativar sincronização de pastas
  config.vm.synced_folder ".", "/vagrant", disabled: false

  # Provisionamento de instalação (Apache, PHP, Composer, Symfony, Docker, etc.)
  config.vm.provision "shell", path: ".vagrant/Provisionamento/provision.sh", reboot: true
  config.vm.provision "shell", path: ".vagrant/Provisionamento/provision2.sh", reboot: true
  config.vm.provision "shell", path: ".vagrant/Provisionamento/provision3.sh", reboot: true
  config.vm.provision "shell", path: ".vagrant/Provisionamento/provision4.sh", run: "always"
end
