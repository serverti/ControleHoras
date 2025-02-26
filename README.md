## Dependências

### Configurações das Variáveis do ambiente de desenvolvimento.

<blockquote>
<p>Comente a variável "DATABASE_URL"</p>
<a href=".env">.env</a>

```dotenv, .env
...
# DATABASE_URL=...
...
```

</blockquote>

Crie uma cópia do arquivo .env.dev para .env.dev.local e altere as informações de conexão com o banco de dados

<blockquote>
<a href=".env.dev.local">.env.dev.local</a>

```Dotenv, .env.dev.local
...
MARIADB_ROOT_PASSWORD="ROOTPASSWORD"
MARIADB_USER="USERBD"
MARIADB_DATABASE="DATABASENAME"
MARIADB_PASSWORD="USERBDPASSWORD"
DATABASE_URL="mysql://${MARIADB_USER}:${MARIADB_PASSWORD}@${MARIADB_SERVER}:${MARIADB_PORT}/${MARIADB_DATABASE}?serverVersion=${MARIADB_VERSION}&charset=${MARIADB_CHARSET}&collation=${MARIADB_CHARSET_COLLATION}"
...
```

</blockquote>

### Ambiente Utilizando Linux + PHP + docker-composer Local

Este comando destrói o banco de dados a cada inicialização. Remover os parâmetros para manter os dados "
--renew-anon-volumes --remove-orphans --force-recreate --build".

O composer cria o serviço do banco de dados mysql e o adminer para gerenciamento do banco.

```shell
docker compose --env-file .env.dev.local -f compose.yaml -p controlehoras up -d --renew-anon-volumes --remove-orphans --force-recreate --build

```

<blockquote>
<p>Adminer</p>
<a href="http://localhost:10180">http://localhost:10180</a>
</blockquote>

### Comandos de preparação do ambiente de desenvolvimento.

````shell
#Comandos linux sem interatividade
composer install
APP_ENV=dev APP_DEBUG=1 composer dump-env dev
APP_ENV=dev APP_DEBUG=1 composer dump-autoload -o
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:schema:update --force 
(echo -e "y\n") | php bin/console doctrine:fixtures:load
php bin/console importmap:install
php bin/console assets:install
php bin/console asset-map:compile
php bin/console cache:clear
````

<blockquote>
<p>Banco de Horas</p>
Executando o servidor localmente.

```shell
php -S localhost:8888 -t public/
```

Banco de Horas <a href="http://localhost:10180">http://localhost:10180</a>
</blockquote>

### Comandos para otimizar a criação de código.

Exemplo de um novo módulo relacional "Tipo de Atendimento".
Essa nova entity será utilizada na classe BancoHoras e altera a propriedade $tipoAtendimento de string para o objeto.
Também será criada a associação Um para Um. O objeto BancoHoras possui um TipoAtendimento.

1. Remova a propriedade $tipoAtendimento e seus métodos get e set.
2. Crie a nova classe (comando abaixo).
3. Refatore o código atualizando a classe BancoHoras (comando abaixo).
4. Atualize o banco de dados com a nova relação (comando abaixo).

<blockquote>
# Execute os comandos na pasta do projêto

```shell
php bin/console make:entity TipoAtendimento

# Comando Interativo

php bin/console make:entity BancoHoras --overwrite

Your entity already exists! So let's add some new fields!
New property name (press <return> to stop adding fields):
 > tipoAtendimento

Field type (enter ? to see all types) [string]:
 > OneToOne

 What class should this entity be related to?:
 > App\Entity\TipoAtendimento

 Is the BancoHoras.tipoAtendimento property allowed to be null (nullable)? (yes/no) [yes]:
 > yes

 Do you want to add a new property to TipoAtendimento so that you can access/update BancoHoras objects from it - e.g. $tipoAtendimento->getBancoHoras()? (yes/no) [no]:
 > no

 updated: src/Entity/BancoHoras.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 
 
php bin/console make:migration

php bin/console doctrine:migrations:migrate

php bin/console make:admin:crud
```

</blockquote>