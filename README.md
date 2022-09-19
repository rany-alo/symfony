# symfony

## Descriptif du projet

Vous attaquez les frameworks web les plus utilisés, et Symfony arrive donc dans les
premiers de votre liste. A travers la création d’un blog, vous allez apprendre à installer et
paramétrer Symfony sur votre machine selon vos préférences, et à utiliser cet outil à la
fois très puissant et très complexe.
Votre base de données devra être mise en place grâce à Doctrine et (au minimum) être
composée de :
- Une table Users
- Une table Articles
- Une table Comments
Votre blog devra avoir les fonctionnalités suivantes :
- Se créer un compte et se connecter
- Poster des articles
- Poster des commentaires sur des articles
Votre blog devra contenir :
- Une page de login
- Une page avec tous les articles
- Une page de détail pour l’article cliqué, avec les commentaires associés en
dessous et un formulaire pour en rentrer un nouveau
- Une page profil sur laquelle on peut modifier nos informations

## Votre code devra contenir :
- Un controller
- Un fichier Twig de base (qui sera extends), ainsi qu’un fichier twig pour chacune
de vos pages.
Pour vous aider :
- Utilisez un template bootstrap pour faire le style de votre site
- Utilisez Doctrine pour lier votre projet avec votre base de données
- Utilisez les fixtures pour créer des fausses données dans votre bdd et tester
votre site
- Installez l’extension Twig Language sur VSCode
- Installez l’extension Emmet sur VSCode

## Pré requis

Veuillez installer :
- Symfony 6
- PHP 8 ou plus
- Composer 2
Vérifiez la version de chacun de ces outils en ouvrant un terminal et en exécutant les
commandes suivantes :
- bin/console - -version
- php -v
- composer -V

## Bonus

- Implémentez un système de like et dislike sur votre blog
- Ajoutez un panel administrateur et des fonctionnalités propres à l’admin

## Rendu

Le projet est à rendre sur https://github.com/prenom-nom/symfony, et à héberger sur
votre plesk.
Pensez à donner les droits sur le répertoire à deepthoughtlaplateforme !

Base de connaissances

● Installation de Symfony
● Base de données et Doctrine
● Authentification et autorisation avec Symfony
● Panel Admin avec Symfony
