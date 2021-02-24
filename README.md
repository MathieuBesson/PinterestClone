<br />
<p align="center">
<img src="https://cdn.worldvectorlogo.com/logos/pinterest-1.svg" alt="Logo" width="150" height="150">
  <h3 align="center">Panterest</h3>
  <p align="center">
    A simple Pinterest Clone
  </p>
</p>

<!-- ABOUT THE PROJECT -->
## Le Projet

Projet crée dans le but de comprendre Symfony, son fonctionnement et son architecture.

### Built With

* [Symfony](https://symfony.com/)

<!-- GETTING STARTED -->
## Getting Started

### Prérequis

* Composer
* PHP8

### Installation

1. Cloner le repository
   ```sh
   git clone https://github.com/MathieuBesson/PinterestClone.git
   ```
2. Installer les dépendances
   ```sh
   composer install
   ```
3. Changer DATABASE_URL dans .env ou a part dans .env.local 
    ```sh
    DATABASE_URL='mysql://root:root@127.0.0.1:3306/panterest'
    ```

4. Lancer les migrations
    ```sh
    php symfony console doctrine:migrations:migrate
    ```

5. Lancer le serveur
    ```sh
    php bin/console server:start
    ```

<!-- CONTACT -->
## Contact

* [Twitter](https://twitter.com/BessonMathieu3)
* [CV en ligne](https://mathieu-besson.netlify.app/)
