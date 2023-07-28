# shopping_demo
## Projet pour portfolio web

Projet pour Portfolio.
Ce site est un exemple de site e-commerce.

## Requis

* [PHP 8.2.0 ou supérieur](https://www.php.net/downloads.php#v8.2.8)
* [Symfony 6.2 ou supérieur](https://symfony.com/download)

## Initialisation du projet


1. $ `git clone https://github.com/Alker51/shopping_demo.git`
2. $ `cd shopping_demo`
3. $ `composer install`
4. $ `php bin/console doctrine:database:create`
5. $ `php bin/console doctrine:schema:create`
6. $ `php bin/console doctrine:migrations:migrate`