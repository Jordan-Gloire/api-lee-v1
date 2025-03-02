# 📚 API Gestion des Apprenants et Formations

## 🚀 Description

Cette API, construite avec **Laravel**, permet de gérer les apprenants et leurs inscriptions aux formations. Elle est conçue pour être consommée par une application web (front-end).

## 🛠️ Technologies utilisées

- **PHP 8.x**
- **Laravel 10.x**
- **MySQL**
- **Composer**
- **Git**

## 📌 Installation

### 1️⃣ Cloner le projet

```bash
git clone https://github.com/ton-utilisateur/nom-du-repo.git
cd nom-du-repo
```

### 2️⃣ Installer les dépendances

```bash
composer install
```

### 3️⃣ Configurer l'environnement

Copier le fichier `.env.example` et renommer en `.env` :

```bash
cp .env.example .env
```

Modifier les informations de connexion à la base de données dans `.env`.

### 4️⃣ Générer la clé de l’application

```bash
php artisan key:generate
```

### 5️⃣ Exécuter les migrations et seeders

```bash
php artisan migrate --seed
```

### 6️⃣ Lancer le serveur local

```bash
php artisan serve
```

L'API sera accessible à : `http://127.0.0.1:8000`

## 📡 API Endpoints

### 🔹 Apprenants

| Méthode | URL                    | Description                              |
| ------- | ---------------------- | ---------------------------------------- |
| GET     | `/api/apprenants`      | Récupérer tous les apprenants            |
| GET     | `/api/apprenants/{id}` | Récupérer un apprenant et ses formations |
| POST    | `/api/apprenants`      | Ajouter un nouvel apprenant              |
| PUT     | `/api/apprenants/{id}` | Mettre à jour un apprenant               |
| DELETE  | `/api/apprenants/{id}` | Supprimer un apprenant                   |

### 🔹 Formations

| Méthode | URL                    | Description                                 |
| ------- | ---------------------- | ------------------------------------------- |
| GET     | `/api/formations`      | Récupérer toutes les formations             |
| GET     | `/api/formations/{id}` | Récupérer une formation avec ses apprenants |
| POST    | `/api/formations`      | Ajouter une nouvelle formation              |
| PUT     | `/api/formations/{id}` | Mettre à jour une formation                 |
| DELETE  | `/api/formations/{id}` | Supprimer une formation                     |

## 🔑 Authentification

Cette API est sécurisée avec **Laravel Sanctum** pour gérer l'authentification des utilisateurs.

## 📜 Modèle de la table pivot `apprenant_formation`

Cette table gère l'association entre les apprenants et les formations avec des informations supplémentaires :

```php
Schema::create('apprenant_formation', function (Blueprint $table) {
    $table->id();
    $table->foreignId('apprenant_id')->constrained('apprenants')->onDelete('cascade');
    $table->foreignId('formation_id')->constrained('formations')->onDelete('cascade');
    $table->date('date_inscription');
    $table->string('statut');
    $table->timestamps();
});
```

`date_inscription` : Date d'inscription de l'apprenant à la formation.\
`statut` : Statut de l'apprenant dans la formation (`en cours`, `terminé`, etc.).

## 🎯 Améliorations futures

- 🔹 Ajout de filtres et de recherches avancées
- 🔹 Génération de certificats en PDF pour les apprenants

## 👤 Auteur

- **Jordan Gloire**
- Linkedin [https://www.linkedin.com/in/baz-s-gloire-fiyss-4022ba271/](https://www.linkedin.com/in/baz-s-gloire-fiyss-4022ba271/)

---

Si ce projet t’a été utile, n’hésite pas à laisser une ⭐ sur le repo ! 😊

