# DarHorizon


![Aperçu du site](/public/assets/img/402shots_so.png)


## Description

darHorizon est une plateforme innovante facilitant la location de maisons et d’appartements, conçue pour les touristes assistant aux événements du Mondial 2030 Morocco-Spain-Portugal.

Ce projet vise à poser les bases d’une plateforme intuitive et sécurisée en mettant l’accent sur :

- 🔒 **L’authentification sécurisée des utilisateurs.**
- 🏡 **La gestion des annonces de location.**
- 🔍 **La recherche avancée d’hébergements.**

## Fonctionnalités

### **PHASE 1 : Fonctionnalités de base**

#### 🔑 Authentification et gestion des utilisateurs

- Inscription et connexion sécurisées pour les propriétaires et touristes (Laravel).
- Accès à un espace personnel.
- Consultation et modification des informations personnelles.

#### 🏡 Gestion des annonces (Propriétaires)

- Publication d’annonces avec localisation, prix, équipements et disponibilités.
- Modification et suppression des annonces (CRUD complet).

#### 📌 Recherche et exploration des hébergements (Touristes)

- Exploration des offres avec une pagination dynamique (4, 10, 25 annonces par page).
- Recherche avancée par ville et disponibilité.
- Enregistrement d’annonces en favoris.

#### 🗑️ Gestion de la plateforme (Administrateurs)

- Suppression des annonces inappropriées ou frauduleuses.
- Section de statistiques pour suivre les inscriptions, locations et annonces actives.

### **PHASE 2 : Améliorations et paiements**

#### 📅 Gestion des disponibilités et réservations

- Choix des dates d’arrivée et de départ avec un calendrier interactif.
- Mise à jour en temps réel des disponibilités.
- Gestion des périodes de disponibilité et suivi des réservations (propriétaires).
- Notifications aux propriétaires lors d’une réservation.

#### 💳 Paiement en ligne

- Intégration de **PayPal** (mode test) pour le paiement sécurisé.
- Envoi automatique d’un email de confirmation après paiement.

#### 📊 Tableau de bord administrateur

- Suivi des paiements et réservations.

## Technologies Utilisées

- **Laravel** : Authentification et gestion des utilisateurs.
- **Carbon** : Gestion des dates et disponibilités.
- **Stripe/PayPal** : Paiement en ligne.
- **MySQL** : Stockage des données.
- **Tailwind** : Interface utilisateur responsive.
