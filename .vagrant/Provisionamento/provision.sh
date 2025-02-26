#!/bin/bash

# Adicionando caminhos comuns ao PATH
PATH=$PATH:/home/vagrant/.local/bin:/home/vagrant/bin:/usr/local/bin:/usr/bin:/usr/local/sbin:/usr/sbin

echo "[INFO] Iniciando provisionamento de Apache, PHP 8.2, Nano e desativação do SELinux..."

# Atualizar pacotes existentes no sistema
sudo dnf update -y

# Instalar Apache
sudo dnf install -y httpd

# Habilitar e iniciar o serviço do Apache
sudo systemctl enable httpd
sudo systemctl start httpd

# Instalar Nano
sudo dnf install -y nano

# Instalar repositórios EPEL e Remi
sudo dnf install -y https://dl.fedoraproject.org/pub/epel/epel-release-latest-9.noarch.rpm
sudo dnf install -y https://rpms.remirepo.net/enterprise/remi-release-9.rpm

# Habilitar o módulo PHP 8.2 do Remi
sudo dnf module reset php -y
sudo dnf module enable php:remi-8.2 -y

# Instalar PHP 8.2 e extensões necessárias para Symfony
sudo dnf install -y php php-cli php-mbstring php-xml php-intl php-zip php-opcache php-pdo php-mysqlnd

# Desativar SELinux temporariamente e configurar permanentemente
sudo setenforce 0
sudo sed -i 's/^SELINUX=.*/SELINUX=disabled/g' /etc/selinux/config

# Verificar se o PHP foi instalado corretamente
if ! php -v > /dev/null; then
  echo "[ERROR] PHP não foi instalado corretamente." >&2
  exit 1
fi

# Reiniciar Apache apenas se necessário
if ! sudo systemctl is-active httpd; then
  sudo systemctl restart httpd
fi

echo "[INFO] Provisionamento de Apache, PHP 8.2, Nano e desativação do SELinux concluído."
