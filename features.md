# Fonctionnalités — Espoir Canin

## Navigation & UX

- **Menu responsive** : hamburger sur mobile, navigation complète sur desktop
- **Header dynamique** : se compacte au scroll (opacité + padding)
- **Scroll reveal** : animations d'apparition au défilement (Intersection Observer)
- **Smooth scroll** : navigation par ancres fluide (CSS + JS)
- **Design sombre** : thème dark avec accents verts (#59d600), glassmorphism, cartes avec bordure translucide

## Contenu & Pages

- **Accueil** : hero avec CTA, présentation, horaires, missions, valeurs
- **Services** : éducation canine, rééducation comportementale, programme chiot
- **Planning dynamique** : chargement JSON depuis `assets/events.json`, filtres par type (balade/cours/mantrailing/stage), masquage automatique des dates passées
- **Tarifs** : grille tarifaire 2026, tableaux par catégorie
- **Pension** : deux formules (chenil rustique avec parc, familiale au foyer)
- **Croquettes** : vente alimentation Origin's, présentation gamme
- **Contact** : formulaire avec envoi PHP/PHPMailer (double SMTP LWS + Gmail fallback), carte Google Maps, coordonnées
- **Pages légales** : CGV (HTML + ODT + PDF téléchargeables), mentions légales

## Administration (back-office David)

- **Panel admin sécurisé** : connexion par mot de passe (`admin/auth.php`, gitignoré)
- **CRUD événements** : ajout/suppression de dates de planning via formulaire web
- **Mise à jour immédiate** : modification du fichier `assets/events.json` en temps réel

## Performance

- **Images WebP** : format moderne, lazy loading (`loading="lazy"`)
- **Compression Gzip** : HTML, CSS, JS, JSON, SVG (`.htaccess`)
- **Cache navigateur** : 1 mois images/polices, 1 semaine CSS/JS, 1 jour HTML
- **CSS variables** : design tokens centralisés, pas de feuilles dupliquées

## SEO

- **Open Graph** + **Twitter Cards** sur toutes les pages
- `meta description`, `keywords`, `canonical` par page
- `robots.txt` + `sitemap.xml` (10 pages indexables)
- **Google Fonts** : Inter (corps) + Outfit (titres), chargement optimisé

## Sécurité

- **HTTPS forcé** + redirection www → non-www (`.htaccess`)
- **Headers** : X-Frame-Options SAMEORIGIN, X-Content-Type-Options nosniff, X-XSS-Protection, Referrer-Policy
- **Fichiers sensibles** : `auth.php`, `config.php`, `contact_process.php`, `api/contact.js` gitignorés
- **Blocage** : `send_mail.php` et dotfiles bloqués par `.htaccess`
- **Historique git nettoyé** : aucun credential dans l'historique (audit 07/2026)

## Hébergement

- **LWS mutualisé** : Apache, support PHP natif, pas de build
- **FTP manuel** : pas de CI/CD, pas de déploiement automatique
- **Domaine** : `espoir-canin.fr` — registrar + DNS LWS
