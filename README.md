# Espoir Canin — Site Web Officiel

Site vitrine professionnel pour **Espoir Canin**, éducation et rééducation canine à Natzwiller (67130), Alsace.

**→ https://espoir-canin.fr/**

## Stack

| Technologie | Usage |
|-------------|-------|
| HTML5 / CSS3 | Structure, styles, variables CSS, animations |
| JavaScript (vanilla) | Menu mobile, scroll reveal, planning dynamique |
| PHP 8.x | Admin panel (CRUD événements), formulaire de contact (PHPMailer) |
| Node.js (Vercel) | Serverless `api/contact.js` (Nodemailer, déploiement Vercel automatique) |
| Google Fonts | Inter + Outfit |
| Google Maps | Carte de localisation page contact |

## Pages

| Page | Description |
|------|-------------|
| `index.html` | Accueil, hero, présentation, horaires |
| `services.html` | Éducation, rééducation, chiot |
| `pension.html` | Pension chenil + familiale |
| `planning.html` | Calendrier dynamique (filtres par type) |
| `tarifs.html` | Grille tarifaire |
| `croquettes.html` | Vente alimentation Origin's |
| `contact.html` | Formulaire + carte Maps |
| `conseils.html` | Conseils canins (en cours) |
| `cgv.html` | Conditions générales de vente |
| `mentions-legales.html` | Mentions légales |

## Développement local

```bash
# Serveur HTTP simple (HTML/CSS/JS seulement)
# Les pages PHP admin + contact nécessitent un serveur avec PHP
php -S localhost:8000
```

Ou avec Live Server (VS Code) pour les pages statiques.

## Déploiement

- **Site statique + PHP** : Hébergement mutualisé LWS (Apache, IP `83.229.19.69`)
- **Fonction contact** : Serverless Vercel (déploiement automatique depuis GitHub)
- **Admin panel** : `https://espoir-canin.fr/admin/` (mot de passe dans `admin/auth.php`)
- **Pas de CI/CD** : Déploiement FTP manuel ou Vercel auto depuis `main`

## Contact

- **David Koessler** — éducateur canin : espoir.canin@outlook.fr / 06.76.02.25.86
- **Geoffroy Streit** — développement : geoffroy.streit@gmail.com

© 2026 Espoir Canin
