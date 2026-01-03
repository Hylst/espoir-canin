# 📁 Structure du Projet - Espoir Canin

## 🌳 Arborescence Complète

```
EspoirCaninv2/
│
├── 📄 index.html              # Page d'accueil principale
├── 📄 services.html           # Services d'éducation & rééducation
├── 📄 pension.html            # Pension canine (Chenil & Familiale)
├── 📄 planning.html           # Calendrier des événements
├── 📄 tarifs.html             # Grille tarifaire complète
├── 📄 croquettes.html         # Vente de croquettes Origin's
├── 📄 contact.html            # Formulaire de contact
├── 📄 conseils.html           # Page conseils (à développer)
├── 📄 cgv.html                # Conditions Générales de Vente
├── 📄 mentions-legales.html   # Mentions légales RGPD
│
├── 📄 robots.txt              # Directives pour les robots d'indexation
├── 📄 sitemap.xml             # Plan du site pour le SEO
├── 📄 send_mail.php           # Script PHP (backup, non utilisé)
│
├── 📚 README.md               # Documentation principale
├── 📚 ABOUT.md                # À propos du projet
├── 📚 CHANGELOG.md            # Historique des versions
├── 📚 STRUCTURE.md            # Ce fichier
│
├── 📁 assets/                 # Ressources statiques
│   │
│   ├── 📁 css/
│   │   └── 📄 style.css       # Feuille de styles principale
│   │
│   ├── 📁 js/
│   │   ├── 📄 main.js         # Scripts principaux
│   │   └── 📄 planning.js     # Script du planning (si séparé)
│   │
│   ├── 📁 images/             # Images du site
│   │   ├── 🖼️ hero-home-ai.jpg
│   │   ├── 🖼️ logo-titre-espoir-canin.png
│   │   ├── 🖼️ logo_footer.png
│   │   ├── 🖼️ services-*.jpg
│   │   ├── 🖼️ pension-*.jpg
│   │   ├── 🖼️ collectif-*.jpg
│   │   └── 🖼️ ... (27 images)
│   │
│   ├── 📁 docs/
│   │   └── 📄 cgv.odt         # CGV téléchargeables
│   │
│   ├── 📁 php/                # Librairies PHP (backup)
│   │   └── 📁 PHPMailer/
│   │
│   └── 📄 events.json         # Données du planning
│
└── 📁 data/
    └── 📄 events.json         # Événements (copie ou lien)
```

---

## 📄 Description des Fichiers HTML

### Pages Principales

| Fichier | Description | SEO Priority |
|---------|-------------|--------------|
| `index.html` | Page d'accueil avec hero, présentation et horaires | 1.0 (max) |
| `services.html` | Détail des services : éducation, rééducation, chiot | 0.8 |
| `pension.html` | Deux formules de pension (Chenil + Familiale) | 0.8 |
| `planning.html` | Calendrier dynamique des activités | 0.8 |
| `tarifs.html` | Grille tarifaire complète | 0.8 |
| `contact.html` | Formulaire + carte Google Maps | 0.7 |
| `croquettes.html` | Vente de croquettes Origin's | 0.6 |
| `conseils.html` | Conseils canins (en construction) | 0.6 |

### Pages Légales

| Fichier | Description | Indexation |
|---------|-------------|------------|
| `cgv.html` | Conditions Générales de Vente | noindex |
| `mentions-legales.html` | Mentions légales obligatoires | noindex |

---

## 🎨 Architecture CSS

### Variables CSS (`:root`)

```css
/* Couleurs principales */
--color-primary: #59d600;        /* Vert Espoir Canin */
--color-primary-dark: #4ab300;
--color-secondary: #b73d3d;
--color-accent: #233452;

/* Neutres */
--color-bg-dark: #0f172a;        /* Slate 900 */
--color-bg-darker: #020617;      /* Slate 950 */
--color-surface: #1e293b;        /* Slate 800 */

/* Typographie */
--font-heading: 'Outfit', sans-serif;
--font-body: 'Inter', sans-serif;
```

### Classes Utilitaires

| Classe | Usage |
|--------|-------|
| `.container` | Conteneur centré (max-width: 1200px) |
| `.btn-primary` | Bouton vert principal avec gradient |
| `.btn-outline` | Bouton bordure verte |
| `.hover-zoom` | Animation zoom au survol |
| `.hover-scale` | Animation scale au survol |
| `.reveal` | Animation de révélation au scroll |

---

## 📊 Données JSON

### `events.json` - Structure

```json
[
  {
    "date": "2025-01-15",
    "time": "10:00",
    "type": "balade",     // balade | cours | mantrailing
    "title": "Balade collective Schirmeck",
    "description": "Promenade d'1h30 en forêt..."
  }
]
```

### Types d'événements

| Type | Couleur Badge | Description |
|------|---------------|-------------|
| `balade` | 🟢 Vert | Balades éducatives en groupe |
| `cours` | 🔵 Bleu | Cours collectifs d'éducation |
| `mantrailing` | 🟠 Orange | Séances de pistage |

---

## 🔗 Liens Externes

### Services Tiers

| Service | Usage | URL |
|---------|-------|-----|
| **Formspree** | Formulaire de contact | formspree.io |
| **Google Fonts** | Typographies | fonts.google.com |
| **Google Maps** | Carte de localisation | maps.google.com |
| **Facebook** | Réseau social | facebook.com |

### Hébergement

| Élément | Fournisseur |
|---------|-------------|
| Domaine | espoir-canin.fr |
| Hébergement | LWS |

---

## 🔍 SEO & Métadonnées

### Balises présentes sur chaque page

```html
<!-- SEO de base -->
<title>...</title>
<meta name="description" content="...">
<meta name="keywords" content="...">
<link rel="canonical" href="https://espoir-canin.fr/...">

<!-- Open Graph (Facebook) -->
<meta property="og:url" content="...">
<meta property="og:title" content="...">
<meta property="og:description" content="...">
<meta property="og:image" content="...">

<!-- Twitter Cards -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="...">
```

### Fichiers SEO

- `robots.txt` - Autorise tous les robots, pointe vers sitemap
- `sitemap.xml` - Liste les 10 pages indexables

---

## 📱 Responsive Design

### Breakpoints

| Taille | Cible | Comportement |
|--------|-------|--------------|
| < 768px | Mobile | Menu hamburger, colonnes empilées |
| 768px - 992px | Tablette | Grilles 2 colonnes |
| > 992px | Desktop | Layout complet, header fixe |

---

## 🛠️ Maintenance

### Fichiers à mettre à jour régulièrement

1. **`assets/events.json`** - Planning des événements
2. **`tarifs.html`** - Grille tarifaire si modification
3. **`sitemap.xml`** - Dates de dernière modification

### Optimisations recommandées

- [ ] Compression des images en WebP
- [ ] Mise en cache via .htaccess
- [ ] Lazy loading des images hors viewport
- [ ] Minification CSS/JS en production

---

*Documentation générée le 3 janvier 2025*
