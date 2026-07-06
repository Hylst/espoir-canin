# Structure du Projet — Espoir Canin

## Arborescence

```
EspoirCaninv2/
├── index.html              # Page d'accueil principale
├── services.html           # Services d'éducation & rééducation
├── pension.html            # Pension canine (Chenil & Familiale)
├── planning.html           # Calendrier dynamique des événements
├── tarifs.html             # Grille tarifaire complète
├── croquettes.html         # Vente de croquettes Origin's
├── contact.html            # Formulaire de contact (PHP/PHPMailer)
├── conseils.html           # Page conseils (en construction)
├── cgv.html                # Conditions Générales de Vente
├── mentions-legales.html   # Mentions légales RGPD
├── 404.html                # Page d'erreur personnalisée
│
├── robots.txt              # Directives pour les robots d'indexation
├── sitemap.xml             # Plan du site pour le SEO
│
├── assets/
│   ├── css/
│   │   └── style.css       # Feuille de styles principale (~570 lignes, variables CSS)
│   ├── js/
│   │   └── main.js         # Scripts (menu mobile, scroll reveal, header)
│   ├── images/             # Images WebP (22 fichiers)
│   ├── docs/
│   │   └── cgv_espir_canin.pdf  # CGV téléchargeables
│   ├── events.json         # Données du planning
│   └── php/
│       └── PHPMailer/      # Librairie PHPMailer
│
├── admin/                  # Panel d'administration PHP
│   ├── auth.php            # Authentification (gitignoré)
│   ├── index.php           # Gestion des événements
│   ├── login.php           # Page de connexion
│   └── logout.php          # Déconnexion
│
├── README.md               # Documentation principale
├── AGENTS.md               # Guide pour agents IA
├── features.md             # Liste des fonctionnalités
├── CHANGELOG.md            # Historique des versions
├── .htaccess               # Configuration Apache (HTTPS, cache, sécurité)
├── .gitignore              # Fichiers exclus du dépôt
├── contact_process.php     # Script d'envoi email (gitignoré)
└── contact_process.php.example  # Template sans credentials
```

## Fichiers sensibles (gitignorés)

| Fichier | Contient |
|---------|----------|
| `admin/auth.php` | Mot de passe admin |
| `admin/config.php` | Configuration admin |
| `contact_process.php` | Credentials SMTP (LWS + Gmail) |
| `api/` | Ancien dossier Vercel (supprimé, gitignoré) |

## Données JSON

### `assets/events.json` — Structure

```json
[
  {
    "id": 1,
    "date": "2026-01-15",
    "time": "10:00",
    "type": "balade",
    "title": "Balade collective Schirmeck",
    "description": "Promenade d'1h30 en forêt...",
    "image": "assets/images/collectif-main.webp"
  }
]
```

### Types d'événements

| Type | Badge | Description |
|------|-------|-------------|
| `balade` | Vert | Balades éducatives en groupe |
| `cours` | Bleu | Cours collectifs d'éducation |
| `mantrailing` | Orange | Séances de pistage |
| `stage` | Violet | Stages ou événements spéciaux |

## Services externes

| Service | Usage |
|---------|-------|
| Google Fonts | Typographies (Inter, Outfit) |
| Google Maps | Carte de localisation |

## Responsive Design — Breakpoints

| Taille | Cible |
|--------|-------|
| < 768px | Mobile (menu hamburger, colonnes empilées) |
| 768px - 992px | Tablette (grilles 2 colonnes) |
| > 992px | Desktop (layout complet, header fixe) |

## Architecture CSS — Variables principales

```css
--color-primary: #59d600;       /* Vert signature */
--color-primary-dark: #4ab300;
--color-bg-dark: #0f172a;       /* Fond sections */
--color-bg-darker: #020617;     /* Fond principal */
--color-surface: #1e293b;       /* Fonds cartes */
--font-heading: 'Outfit', sans-serif;
--font-body: 'Inter', sans-serif;
```

---

*Dernière mise à jour : juillet 2026*
