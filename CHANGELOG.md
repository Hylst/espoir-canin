# 📋 Changelog - Espoir Canin

Toutes les modifications notables de ce projet sont documentées dans ce fichier.

Le format est basé sur [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/).

---

## [2.2.1] - 2026-09-10

### 🐛 Correction
- **Pages "noires" / zones vides (smartphone ET desktop, page Tarifs notamment) : SUPPRESSION COMPLÈTE du scroll-reveal.** L'animation masquait le contenu avec `opacity: 0` en attendant l'`IntersectionObserver`, et il suffisait d'un fichier CSS/JS en cache désynchronisé pour tout cacher (« s'affiche une seconde puis s'efface »).
  - Le mécanisme décoratif de scroll-reveal a été **entièrement retiré** (CSS + JS).
  - Le contenu est désormais **toujours visible à 100 %**, sur desktop comme sur mobile, quel que soit le navigateur ou le cache.
  - Plus aucun `opacity: 0` ni `transform` lié au reveal ; les autres fonctionnalités (menu mobile, header dynamique, smooth scroll) sont conservées.

### 🚀 Amélioration anti-cache (smartphone)
Le problème persistait sur mobile car le navigateur servait encore les **anciens `style.css` + `main.js`** en cache (le HTML étant lui-même mis en cache 1 jour par le `.htaccess`).
- **Garde-fou inline sur les 11 pages** : un `<style>` dans le `<head>` force `opacity:1 !important` sur toute classe `.reveal` résiduelle. Comme il est dans le HTML, il s'applique même si d'anciens CSS/JS sont en cache → plus aucune zone noire.
- **Cache-busting `?v=2.2.1`** ajouté sur `style.css` et `main.js` de toutes les pages.
- **`.htaccess`** : le HTML n'est plus mis en cache (`Expires text/html 0s` + `Cache-Control: no-cache`) pour que les nouvelles versions soient prises en compte immédiatement.

### 🛡️ Purge anti-cache déterministe (JS)
Malgré des en-têtes corrects en production, un navigateur mobile pouvait encore servir un **ancien `main.js`/`style.css` en cache local**, même après hard refresh, d'où des zones noires persistantes en navigation normale (absentes en navigation privée).
- **Bloc exécuté immédiatement** en tête de `main.js` : injecte un style `!important` forçant `opacity:1 / visibility:visible / transform:none` sur toute classe `.reveal`, retire ces classes du DOM, et **purge les anciens Service Workers + caches** (si un vieux SW était enregistré sur l'appareil).
- Cache-busting du JS passé à `main.js?v=2.2.2` sur les 10 pages.

### 📝 Divers

---

## [2.2.0] - 2026-08-27

### ✨ Ajouté
- **Tarifs éducation individuelle** : « Séance individuelle 1h » (60 €) et « Séance individuelle 1h30 » (80 €)
- **Filtre « Stages »** sur la page planning (les stages apparaissent maintenant aussi dans le hero et les metas SEO)

### 🔄 Modifié
- **Planning** : retrait complet du service « balade collective » (textes, metas SEO, filtre, CSS `.event-type-balade`) + ajout CSS `.event-type-stage`
- **Tarifs** : carte « Cours collectif » (suppression de "Balade collective"), libellés standardisés sans parenthèses, police réduite sur mobile pour garder les libellés sur une ligne
- **Accueil** : nouveaux horaires « Lundi au Vendredi : 9h - 19h (Mercredi jusqu'à 18h45) » à partir du 1er septembre + mention dédiée
- **Admin** : option « Balade » retirée du formulaire d'ajout d'événement ; image par défaut simplifiée

### 🐛 Correction
- **Pages "noires" sur smartphone** : le scroll-reveal masquait tout le contenu si l'`IntersectionObserver` ne se déclenchait pas. Encadrement de l'API avec fallback = contenu toujours visible + désactivation de l'animation sur écrans tactiles (`@media (hover: none)`)

### 📝 Documentation
- **AGENTS.md** : types d'événements mis à jour (`cours`, `mantrailing`, `stage`)
- **STRUCTURE.md** : exemple JSON et tableau des types d'événements mis à jour
- **features.md** : filtres par type et tarifs mis à jour

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
