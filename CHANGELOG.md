# 📋 Changelog - Espoir Canin

Toutes les modifications notables de ce projet sont documentées dans ce fichier.

Le format est basé sur [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/).

---

## [2.1.0] - 2026-07-07

### Sécurité
- **Audit complet des credentials** exposés dans l'historique git
- **Purge de l'historique** : suppression de tous les mots de passe et app passwords des 38 commits
- **Mots de passe gitignorés** : `api/`, `contact_process.php`, `admin/auth.php`, `admin/config.php`
- **node_modules retiré du tracking** : 156 fichiers supprimés du dépôt

### Nettoyage
- **Suppression des 22 fichiers JPG doublons** : toutes les images sont en WebP uniquement
- **Meta OG/Twitter** : remplacement des références .jpg par .webp
- **Dossier `api/`** : supprimé (ancien relicat Vercel, inutilisé)
- **Diffs cosmétiques CSS/HTML** : nettoyés

### Améliorations
- **404.html** : page d'erreur personnalisée (remplace la redirection aveugle vers index.html)
- **CGV** : suppression du lien ODT, PDF uniquement dans les 10 pages HTML
- **contact_process.php.example** : template sans credentials, prêt à être copié

### Documentation
- **AGENTS.md** : réécrit (suppression Vercel, clarification contact form, déploiement, gotchas)
- **README.md** : corrigé (stack réelle, suppression Formspree, instructions FTP)
- **features.md** : créé (liste exhaustive des fonctionnalités)
- **STRUCTURE.md** : mis à jour (arborescence réelle, suppression mentions obsolètes)

---

## [2.0.0] - 2025-01-03

### 🎉 Refonte complète du site

#### ✨ Ajouté
- **Nouveau design moderne** avec thème sombre élégant
- **Animations CSS** subtiles pour une meilleure expérience utilisateur
- **Planning dynamique** chargé depuis un fichier JSON
- **Filtres de catégories** sur la page planning (Balades, Cours, Mantrailing)
- **Système de design** avec variables CSS cohérentes
- **Menu mobile responsive** avec animation hamburger
- **Scroll reveal animations** pour les sections
- **Cards interactives** avec effets hover
- **Documentation complète** (README, ABOUT, CHANGELOG, STRUCTURE)

#### 🔄 Modifié
- **Refonte SEO complète** avec balises Open Graph et Twitter Cards
- **Amélioration des performances** avec images optimisées
- **Structure HTML sémantique** améliorée
- **Formulaire de contact** migré vers Formspree
- **Typographies modernes** (Inter, Outfit) via Google Fonts

#### 🛡️ Sécurité
- Suppression de l'utilisation directe de PHPMailer
- Formulaire de contact externalisé via Formspree

---

## [1.5.0] - 2025-12-14

### 📝 Mises à jour de contenu

#### ✨ Ajouté
- Page **CGV** (Conditions Générales de Vente)
- Page **Mentions Légales** complète
- Fichier **robots.txt**
- **Sitemap XML** pour le référencement

#### 🔄 Modifié
- Mise à jour des tarifs 2025
- Actualisation du planning d'événements
- Optimisation des images pour le web

---

## [1.0.0] - 2025-06-01

### 🚀 Lancement initial

#### ✨ Ajouté
- **Page d'accueil** avec présentation d'Espoir Canin
- **Page Services** détaillant les prestations
- **Page Pension** avec les deux formules disponibles
- **Page Planning** pour les activités collectives
- **Page Tarifs** avec grille tarifaire complète
- **Page Croquettes** pour la vente d'alimentation
- **Page Contact** avec formulaire et carte Google Maps
- Design responsive pour mobile et tablette
- **Logo et identité visuelle** Espoir Canin

---

## 📝 Notes de version

### Conventions de versionnage

Ce projet suit le [Semantic Versioning](https://semver.org/) :
- **MAJEUR** (X.0.0) : Refonte complète ou changements majeurs non rétrocompatibles
- **MINEUR** (0.X.0) : Ajout de fonctionnalités rétrocompatibles
- **PATCH** (0.0.X) : Corrections de bugs et mises à jour mineures

### Légende des icônes

| Icône | Signification |
|-------|---------------|
| ✨ | Nouvelle fonctionnalité |
| 🔄 | Modification/Amélioration |
| 🐛 | Correction de bug |
| 🗑️ | Suppression |
| 🛡️ | Sécurité |
| 📝 | Documentation |

---

## 👤 Auteur

**Geoffroy Streit** - Développeur Web  
📧 geoffry.streit@gmail.com  
🔗 [LinkedIn](https://www.linkedin.com/in/geoffroy-streit/)

---

*Dernière mise à jour : 3 janvier 2025*
