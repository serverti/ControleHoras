#!/bin/bash

echo "### Provisionamento - Instalação de ferramentas adicionais ###"

# Atualizar pacotes e instalar dependências

 
sudo dnf install -y git unzip curl yum-utils device-mapper-persistent-data lvm2 dkms.noarch kernel-devel.x86_64 kernel-headers.x86_64  kernel-modules.x86_64

# Instalar Composer
if ! command -v composer &> /dev/null; then
    echo "Instalando Composer..."
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/bin/composer
else
    echo "Composer já instalado. Pulando..."
fi

# Instalar Symfony CLI
if ! command -v symfony &> /dev/null; then
    echo "Instalando Symfony CLI..."
    wget https://get.symfony.com/cli/installer -O symfony.sh
    sudo bash symfony.sh --install-dir=/usr/local/bin --filename=symfony
    rm symfony.sh
else
    echo "Symfony CLI já instalado. Pulando..."
fi

# Instalar Docker
if ! command -v docker &> /dev/null; then
    echo "Instalando Docker..."
    sudo dnf config-manager --add-repo=https://download.docker.com/linux/centos/docker-ce.repo
    sudo dnf install -y docker-ce docker-ce-cli containerd.io
    sudo systemctl enable --now docker
    sudo usermod -aG docker vagrant
else
    echo "Docker já instalado. Pulando..."
fi

# Instalar Docker Compose
if ! command -v docker-compose &> /dev/null; then
    echo "Instalando Docker Compose..."
    sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
else
    echo "Docker Compose já instalado. Pulando..."
fi

echo "### Provisionamento de ferramentas finalizado! ###"
