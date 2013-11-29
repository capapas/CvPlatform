#CvPlatform
##Introduction
Plateforme pour toute personne souhaitant créer et mettre en forme son Cv. Le site permet aussi de le récuperer au format PDF grâce au bundle ``MhorCvToPdfBundle``

##Installation

```bash
$ cp app/config/parameters.yml.dist app/config/parameters.yml

#Penser à changer USERNAME par son nom d'utilisateur
$ sudo setfacl -R -m u:www-data:rwx -m  u:`whoami`:rwx -m u:USERNAME:rwx app/logs app/cache/
$ sudo setfacl -dR -m u:www-data:rwx -m  u:`whoami`:rwx -m u:USERNAME:rwx app/logs app/cache/
$ sudo chmod -R 777  web/uploads/
```
