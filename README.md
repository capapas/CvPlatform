#CvPlatform [![Build Status](https://travis-ci.org/capapas/CvPlatform.png?branch=master)](https://travis-ci.org/capapas/CvPlatform)
##Introduction
Plateforme pour toute personne souhaitant créer et mettre en forme son Cv. Le site permet aussi de le récuperer au format PDF grâce au bundle ``MhorCvToPdfBundle``

##Installation

```bash
#Copier le fichier parameter.yml.dist en parameter.yml puis l'éditer à votre convenance
$ cp app/config/parameters.yml.dist app/config/parameters.yml

#Penser à changer USERNAME par son nom d'utilisateur
$ mkdir app/logs app/cache
$ sudo setfacl -R -m u:www-data:rwx -m  u:`whoami`:rwx -m u:USERNAME:rwx app/logs app/cache/
$ sudo setfacl -dR -m u:www-data:rwx -m  u:`whoami`:rwx -m u:USERNAME:rwx app/logs app/cache/
$ sudo chmod -R 777  web/uploads/

#Installation via composer
$ composer.phar install

#Base de données
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:update --force
$ php app/console doctrine:fixtures:load
```
