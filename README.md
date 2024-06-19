# Documentation de Mise en Place pour SwapInStyle

## Pré-requis

- PHP 8.x
- Composer
- Node.js
- NPM
- Base de données SQLite
- Optionel: MailTrap

## Étapes d'Installation

### 1. Cloner le Répertoire du Projet

```bash
git clone https://github.com/RicardoEstevesDias/SwapInStyle
cd SwapInStyle
```
### 2. Installer les Dépendances PHP

```bash
composer install
```

### 3. Configurer les Variables d'Environnement

```bash
cp .env.example .env
```

### 4. Générer la Clé de l'Application

```bash
php artisan key:generate
```

### 5. Exécuter les Migrations

```bash
php artisan migrate 
```
### 6. Installer les Dépendances Node.js

```bash
npm install
```
### 7. Compiler les Assets

```bash
npm run dev
```
### 8. Lancer le Serveur de Développement

```bash
php artisan serve
```

Accédez à l'application via http://localhost:8000.
Le paramétrage de MailTrap est indiqué sur celle-ci
