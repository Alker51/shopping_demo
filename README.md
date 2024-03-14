# shopping_demo
## Projet pour portfolio web

Projet pour Portfolio.
Ce site est un exemple de site e-commerce.

## Requis

* [PHP 8.3.0 ou supérieur](https://www.php.net/downloads.php)
* [Symfony 6.2 ou supérieur](https://symfony.com/download)

## Initialisation du projet


1. $ `git clone https://github.com/Alker51/shopping_demo.git`
2. $ `cd shopping_demo`
3. $ `composer install`
4. $ `php bin/console doctrine:database:create`
5. $ `php bin/console doctrine:migrations:migrate`
6. $ `php bin/console doctrine:fixtures:load`

### Idée pour la suite du projet

* API Plateform pour la communication entre Back et Front.
* Il faut améliorer la securité de l'API!!
* React ou autre framework JS pour Front-end.

##### Ce readme doit être amélioré.

### NOTE : 

* Changer le type du numéro de carte en char pour stocker le numéro long (16 caracs) dans la base.
