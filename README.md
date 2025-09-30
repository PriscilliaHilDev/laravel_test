# 📄 Fiche technique — Projet **Azuréa IMMO**

## 📝 1. Informations générales
- **Nom du projet** : Azuréa IMMO  
- **Type d’application** : Plateforme de réservation de biens immobiliers en ligne  
- **Technologies principales** :  
  - **Backend** : Laravel 12 (PHP 8.2)  
  - **Frontend** : Blade, Livewire 3, TallStack UI, TailwindCSS 3.4, Flowbite  
  - **Base de données** : MySQL  
  - **Authentification** : Laravel Breeze / Jetstream  
  - **Administration** : Filament v4  

---

## 🛠️ 2. Fonctionnalités principales
- ✅ Authentification sécurisée (inscription, connexion, gestion du profil, mot de passe, 2FA)  
- ✅ Gestion des propriétés (CRUD via Filament, image par défaut, carousel d’accueil)  
- ✅ Réservations en ligne (datepicker TallStackUI, vérification des disponibilités, calcul du prix total)  
- ✅ Espace utilisateur (liste des réservations, annulation, prix total affiché)  
- ✅ Dark Mode moderne (UI en cartes grises, textes blancs)  
- ✅ Panneau d’administration Filament (utilisateurs, propriétés, réservations)  

---

## ⚙️ 3. Architecture du projet
- **`/app/Models`** → Modèles Eloquent : `User`, `Property`, `Booking`  
- **`/app/Livewire`** → Composants dynamiques : `PropertyList`, `PropertyDetail`, `BookingManager`  
- **`/resources/views/livewire`** → Vues principales (listes, détails, réservations)  
- **`/resources/views/profile`** → Gestion du profil (infos, mot de passe, 2FA, sessions, suppression compte)  
- **`/public/images`** → Images versionnées (slides du carousel, image par défaut property)  
- **`/storage`** → Uploads dynamiques (non versionnés, accessibles via `php artisan storage:link`)  

---

## 📸 4. Interface utilisateur
- **Page d’accueil** : carousel + liste paginée des propriétés  
- **Détail d’un bien** : image principale, description, prix/nuit, datepicker de réservation  
- **Mes réservations** : cartes avec image arrondie, durée, prix total, bouton d’annulation  
- **Profil utilisateur** :  
  - Informations personnelles  
  - Mise à jour du mot de passe  
  - Authentification à deux facteurs (QR code, recovery codes)  
  - Gestion des sessions de navigation  
  - Suppression définitive du compte  

---

## 🔒 5. Sécurité
- Authentification Breeze/Jetstream (sessions, CSRF)  
- Validation Livewire + règles Laravel  
- Authentification à deux facteurs (Google Authenticator, recovery codes)  
- Suppression sécurisée avec confirmation du mot de passe  
- Vérification des conflits de réservation avant validation  

---

## 🚀 6. Déploiement en locale

### Pré-requis
- PHP 8.2+  
- Composer  
- MySQL / MariaDB  
- Node.js 18+ / NPM  

### Étapes d’installation
```bash
# Récupérer le projet
git clone <repo>
cd laravel-test

# Installer les dépendances PHP
composer install

# Copier l'environnement et générer la clé
cp .env.example .env
php artisan key:generate

# Configurer la base de données MySQL dans .env :
DB_DATABASE=azurea_immo
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Lancer les migrations et seeders
php artisan migrate --seed

# Installer les dépendances frontend
npm install

# Compiler les assets en mode développement
composer run dev

# Créer le lien symbolique pour les images uploadées
php artisan storage:link

# Lancer le serveur local
php artisan serve
