Сервис объявлений
==

Deploy
+ git clone https://github.com/alxxc/ad.git
+ composer install
+ bin/console doctrine:database:create
+ bin/console doctrine:schema:update --force
+ bin/console doctrine:fixtures:load
