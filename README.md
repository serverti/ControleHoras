## Dependências

### Comandos de preparação do ambiente de desenvolvimento.

````
composer install
APP_ENV=dev APP_DEBUG=1 composer dump-env dev
php bin/console importmap:install
php bin/console cache:clear
php bin/console doctrine:database:create
php bin/console doctrine:migration:diff
php bin/console doctrine:migration:migrate
php bin/console doctrine:fixtures:load

php -S localhost:8888 -t public/
````