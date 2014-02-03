#CvPlatform [![Build Status](https://travis-ci.org/capapas/CvPlatform.png?branch=master)](https://travis-ci.org/capapas/CvPlatform) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/capapas/CvPlatform/badges/quality-score.png?s=0d76dbd5c1c24ce8a498429e9ffef22397d5d8b5)](https://scrutinizer-ci.com/g/capapas/CvPlatform/) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/88061434-84d4-4cb6-8fb1-b0bdb77b34d3/mini.png)](https://insight.sensiolabs.com/projects/88061434-84d4-4cb6-8fb1-b0bdb77b34d3) [![Dependency Status](https://www.versioneye.com/user/projects/52c563c3ec1375fd7a000003/badge.png)](https://www.versioneye.com/user/projects/52c563c3ec1375fd7a000003) [![Stories in Ready](https://badge.waffle.io/capapas/cvplatform.png?label=ready)](https://waffle.io/capapas/cvplatform)
##Introduction
Plateforme pour toute personne souhaitant créer et mettre en forme son Cv. Le site permet aussi de le récuperer au format PDF grâce au bundle ``MhorCvToPdfBundle``

##Installation

```bash
# Copier le fichier parameter.yml.dist en parameter.yml puis l'éditer à votre convenance
$ cp app/config/parameters.yml.dist app/config/parameters.yml

# Penser à changer USERNAME par son nom d'utilisateur
$ mkdir app/logs app/cache
$ sudo setfacl -R -m u:www-data:rwx -m  u:`whoami`:rwx -m u:USERNAME:rwx app/logs app/cache/
$ sudo setfacl -dR -m u:www-data:rwx -m  u:`whoami`:rwx -m u:USERNAME:rwx app/logs app/cache/
$ sudo chmod -R 777  web/uploads/

# Installation via composer
$ composer.phar install

# Base de données
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:update --force
$ php app/console doctrine:fixtures:load

# Assets
$ php app/console assets:install --symlink
$ php app/console assetic:dump
```
