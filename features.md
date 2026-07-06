# Fonctionnalités — Espoir Canin

## Navigation & UX

- **Menu responsive** : hamburger sur mobile, navigation complète sur desktop
- **Header dynamique** : se compacte au scroll
- **Scroll reveal** : animations d'apparition au défilement (Intersection Observer)
- **Smooth scroll** : navigation par ancres fluide
- **Design sombre** : thème dark avec accents verts (#59d600), glassmorphism

## Contenu & Pages

- **Page d'accueil** : hero avec CTA, présentation, horaires, missions
- **Services** : éducation canine, rééducation, pension, activités collectives
- **Planning dynamique** : chargement JSON, filtres par type (balade/cours/mantrailing/stage), masquage dates passées
- **Tarifs** : grille tarifaire 2026
- **Croquettes** : vente alimentation Origin's
- **Contact** : formulaire avec envoi PHP/PHPMailer, carte Google Maps
- **Pension** : deux formules (chenil rustique, familiale)
- **Pages légales** : CGV, mentions légales

## Administration

- **Panel admin PHP** : connexion par mot de passe, gestion CRUD des événements du planning
- **Mise à jour automatique** : les événements ajoutés sont immédiatement visibles sur le site

## Performance & SEO

- **Images WebP** : 27 images optimisées, lazy loading
- **Compression Gzip** : via `.htaccess` (HTML, CSS, JS, JSON, SVG)
- **Cache navigateur** : 1 mois images/polices, 1 semaine CSS/JS, 1 jour HTML
- **SEO** : balises Open Graph, Twitter Cards, meta description, canonical, robots.txt, sitemap.xml
- **Polices Google Fonts** : Inter (corps) + Outfit (titres)

## Sécurité

- **HTTPS forcé** + www → non-www (`.htaccess`)
- **Headers** : X-Frame-Options, X-Content-Type-Options, X-XSS-Protection, Referrer-Policy
- **Fichiers sensibles** : `.env`, `auth.php`, `config.php`, `contact_process.php` gitignorés
- **PHP bloqué** : `send_mail.php` interdit via `.htaccess`

## Hébergement & Infra

- **Site statique + PHP** : LWS mutualisé (Apache)
- **API contact (backup)** : Vercel serverless (Node.js/Nodemailer)
- **Domaine** : `espoir-canin.fr` — registrar LWS, DNS géré depuis panel LWS
- **Pas de build** : HTML/CSS/JS/PHP natif, zéro dépendance frontend
