# Airneis Backend

Bienvenue dans le backend de **Airneis**, le système de gestion pour notre site e-commerce. Ce projet utilise Symfony pour fournir un back-office complet permettant aux administrateurs de gérer la partie client du site ainsi que d'accéder à des données personnelles et statistiques.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les outils suivants sur votre machine :

- [Git](https://git-scm.com/)
- [PHP](https://www.php.net/) (version 8.0 ou ultérieure)
- [Composer](https://getcomposer.org/)
- [Symfony CLI](https://symfony.com/download) (facultatif mais recommandé)

## Installation

1. **Cloner le dépôt**

   ```bash
   git clone https://github.com/JovickT/airneis_backend.git
   cd airneis_backend

2. **Installer les dépendances**
   ```bash
   composer install

3. **Créer la base de données**

   Exécutez la commande suivante pour créer la base de données. Assurez-vous que le nom de la base de données est airneis :
   ```bash
   php bin/console doctrine:database:create

4. **Appliquer les migrations**

   Mettez à jour la base de données en appliquant les migrations :
   ```bash
   php bin/console doctrine:migrations:migrate

5. **Charger les données de fixtures**

   Chargez les données initiales dans la base de données :
   ```bash
   php bin/console doctrine:fixtures:load

6. **Installer le certificat SSL**

   Pour configurer le serveur avec un certificat SSL local, exécutez la commande suivante :
   ```bash
   symfony server:ca:install
   

##Démarrer le BackOffice

  Pour lancer le back-office, utilisez la commande suivante :
   ```bash
  symfony server:start

   Cela démarrera le serveur de développement et vous pourrez ouviri l'application dans le navigateur de votre choix. Vous pouvez accéder à l'application à l'adresse       
   https://localhost:8000 (par défaut).

  Cela démarrera le serveur Symfony et vous permettra d'accéder à l'interface d'administration via votre navigateur. Pour ce connecter, utiliser l'identifiant :       
  admin@example.com 
  et le mot de passe: admin123

##Fonctionnalités

  Le BackOffice permet aux administrateurs de :

  Interagir avec la partie client du site.
  Accéder à des données personnelles et des statistiques relatives aux utilisateurs et à leur activité.

##Contributions

  Les contributions sont les bienvenues ! Pour proposer des améliorations ou des corrections, veuillez suivre les instructions de contribution dans le dépôt GitHub.

##Licence

##Contact

  Pour toute question ou support, veuillez contacter contact@airneis.com ou ouvrir une issue sur le dépôt GitHub.
  

Merci d'utiliser Airneis ! Nous espérons que vous trouverez notre Api utile et facile à utiliser.
