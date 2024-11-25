# Performia

**Performia** est un projet structuré en plusieurs dossiers pour organiser le code, les outils externes et la documentation.

## Structure du Projet

- **`hub/`** : Contient le projet Laravel principal.
- **`server/`** : Contient les différents outils externes nécessaires au projet, tels que des serveurs ou scripts complémentaires.
- **`documentation/`** : Inclut toutes les documentations associées au projet, comme le MCD de la base de données, les spécifications techniques, etc.

---

## Prérequis

Avant de commencer, assurez-vous que les éléments suivants sont installés sur votre machine :

- [PHP](https://www.php.net/downloads) (version compatible avec Laravel, généralement ≥ 8.1)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) et [npm](https://www.npmjs.com/) (ou [Yarn](https://yarnpkg.com/))
- Un serveur de base de données (MySQL, PostgreSQL, etc.)

---

## Installation et Configuration

### Étape 1 : Cloner le projet
```bash
git clone https://github.com/votre-repo/performia.git
cd performia/hub
```

## Étape 2 : Installer les dépendances

Installez les dépendances PHP :

```bash
composer install
```

Installez les dépendances front-end :

```bash
npm install
```

## Étape 3 : Configuration de l'environnement

Copiez le fichier d'exemple .env et configurez les variables d'environnement :

```bash
cp .env.example .env
```

Générez une clé d'application :

```bash
php artisan key:generate
```

Configurez les paramètres du fichier .env (base de données, mail, etc.).

## Étape 4 : Préparer la base de données

Exécutez les migrations pour créer les tables :

```bash
php artisan migrate
```

Ajoutez les données initiales avec les seeders :

```bash
php artisan db:seed
```

## Étape 5 : Compiler les assets

Pour générer les fichiers CSS et JS en mode production :

```bash
npm run prod
```

A noter que pour le bon fonctionnement du site. Il faut configurer un virtual host de sorte à se que l'url soit directement : performia

## Documentation

La documentation associée au projet est disponible dans le dossier **`documentation/`**, qui inclut :

- **MCD de la base de données** : Modèle conceptuel des données pour comprendre la structure de la base.
- **Spécifications fonctionnelles** : Détails des fonctionnalités implémentées.
- **Guide d'utilisation** : Instructions pour utiliser et tester le projet.
