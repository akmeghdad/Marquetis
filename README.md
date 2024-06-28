# Meghdad ABOLFAZLI test Symfony 
## Vehicle Management System

### Description

Ce projet est un système de gestion des véhicules développé avec Symfony 6.4. Il permet de gérer une liste de propriétaires de véhicules et leurs véhicules associés, ainsi que leurs caractéristiques. L'application offre des fonctionnalités pour ajouter, modifier, supprimer et afficher des véhicules et leurs propriétaires. De plus, elle propose des fonctionnalités de tri et de filtrage des véhicules.

### Fonctionnalités

- Ajouter, modifier, supprimer des propriétaires de véhicules.
- Ajouter, modifier, supprimer des véhicules et leurs caractéristiques.
- Trier la liste des véhicules par différentes colonnes (marque, modèle, date d'immatriculation, etc.).
- Filtrer la liste des véhicules par propriétaire.
- Interface utilisateur responsive grâce à Bootstrap.

### Prérequis

- PHP 8.2 ou plus récent
- Composer

### Installation

1. Clonez le dépôt :

    ```bash
    git clone https://github.com/akmeghdad/Marquetis.git
    cd Marquetis
    ```

2. Installez les dépendances PHP :

    ```bash
    composer install
    ```

3. Démarrez le serveur de développement Symfony :

    ```bash
    symfony server:start
    ```

4. Accédez à l'application dans votre navigateur à l'adresse `http://localhost:8000`.

### Utilisation

- Pour ajouter un nouveau propriétaire, accédez à la page `http://localhost:8000/proprietaire/new`.
- Pour ajouter un nouveau véhicule, accédez à la page `http://localhost:8000/vehicule/new`.
- Pour afficher la liste des véhicules, accédez à la page `http://localhost:8000/vehicule`.

### Intégration des ressources

En raison de problèmes avec la version de npm déjà installée sur mon PC, je n'ai pas utilisé Webpack. Les ressources comme Bootstrap, jQuery, et Chart.js sont incluses directement dans les balises `<head>` des templates.
