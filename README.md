# Espoir Canin — Site Web Officiel

Site vitrine professionnel pour **Espoir Canin**, éducation et rééducation canine à Natzwiller (67130), Alsace.

**→ https://espoir-canin.fr/**

## Stack

| Technologie | Usage |
|-------------|-------|
| HTML5 / CSS3 | Structure, styles, variables CSS, animations |
| JavaScript (vanilla) | Menu mobile, scroll reveal, planning dynamique |
| PHP 8.x | Admin panel (CRUD événements), formulaire de contact (PHPMailer) |
| Google Fonts | Inter + Outfit |
| Google Maps | Carte de localisation |

## Pages

| Page | Description |
|------|-------------|
| `index.html` | Accueil, hero, présentation, horaires |
| `services.html` | Éducation, rééducation, chiot |
| `pension.html` | Pension chenil + familiale |
| `planning.html` | Calendrier dynamique (filtres par type) |
| `tarifs.html` | Grille tarifaire 2026 |
| `croquettes.html` | Vente alimentation Origin's |
| `contact.html` | Formulaire PHP/PHPMailer + carte Maps |
| `conseils.html` | Conseils canins (en cours) |
| `cgv.html` | Conditions générales de vente |
| `mentions-legales.html` | Mentions légales |

## Développement local

```bash
php -S localhost:8000
```

Ou Live Server (VS Code) pour les pages statiques seules (contact form + admin nécessitent PHP).

## Déploiement

- **Hébergement** : LWS mutualisé (Apache, IP `83.229.19.69`)
- **FTP** : Déploiement manuel dans `public_html/`
- **Admin** : `https://espoir-canin.fr/admin/` (mot de passe dans `admin/auth.php`, gitignoré)
- **Pas de CI/CD** : GitHub = synchronisation uniquement

## Déploiement initial / après clonage

1. Copier les fichiers dans `public_html/` via FTP
2. Copier séparément `admin/auth.php` et `contact_process.php` (gitignorés, contiennent les credentials)
3. Vérifier les permissions de `assets/events.json` (644 ou 666 pour l'admin panel)
4. Tester le formulaire de contact et l'admin panel

## Contact

- **David Koessler** — éducateur canin : espoir.canin@outlook.fr / 06.76.02.25.86
- **Geoffroy Streit** — développement : geoffroy.streit@gmail.com

© 2026 Espoir Canin
