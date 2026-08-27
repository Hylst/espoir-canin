# Design — Retrait du service « balade » (Espoir Canin)

Date : 2026-08-27
Statut : validé (approche B)
Auteur : Geoffroy Streit

## Objectif

Le service « balade collective » n'est plus proposé. Retirer toute trace du mot « balade » et du service sur les pages **planning**, **tarifs**, **accueil** et dans le **panel admin**, pour que le site reflète l'offre réelle (cours collectifs, mantrailing, stages).

## Définition du périmètre (approche B validée + ajustements cohérence)

Retrait **complet** :

- `planning.html` — textes, metas SEO, filtre « Balades », CSS `.event-type-balade`, **ajout filtre « Stages » + mentions stages dans hero/titres**
- `tarifs.html` — metas SEO + carte tarif « Cours / Balade collective »
- `admin/index.php` — option « Balade », placeholder, logique d'image auto
- `index.html` — metas SEO (description, keywords, OG, Twitter, JSON-LD) + bandeau services

Ajustements transverses :
- `conseils.html` + `cgv.html` — retrait keyword SEO « balades collectives »
- `AGENTS.md`, `STRUCTURE.md`, `features.md` — mise à jour types événements (cours, mantrailing, stage)
- `assets/events.old` — suppression (fichier untracked, obsolète)

## Modifications par fichier

### 1. `planning.html`

| # | Élément | Avant | Après |
|---|---------|-------|-------|
| 1 | Commentaire tête (L7) | `Calendrier des balades et cours collectifs` | `Calendrier des cours collectifs, stages et mantrailing` |
| 2 | `<title>` (L15) | `Planning Balades & Cours Collectifs \| Espoir Canin - Alsace 67` | `Planning Cours Collectifs, Stages & Mantrailing \| Espoir Canin - Alsace 67` |
| 3 | meta description (L16-17) | `...planning des balades collectives, cours de groupe et séances de mantrailing...` | `...planning des cours collectifs, stages et séances de mantrailing...` |
| 4 | meta keywords (L18-19) | retire `balade collective chien Alsace,` et `balades canines Schirmeck,` | sans balade, ajoute `stage chien Alsace,` |
| 5 | og:title (L37) | `Planning Balades & Cours Collectifs - Espoir Canin` | `Planning Cours Collectifs, Stages & Mantrailing - Espoir Canin` |
| 6 | og:description (L38-39) | `Prochaines dates de balades, cours collectifs et mantrailing...` | `Prochaines dates de cours collectifs, stages et mantrailing...` |
| 7 | twitter:title (L48) | idem og:title | idem |
| 8 | twitter:description (L49) | `...balades, cours collectifs et mantrailing...` | `...cours collectifs, stages et mantrailing...` |
| 9 | CSS `.event-type-balade` (L200-204) | bloc balade vert | supprimé |
| 10 | Hero (L276-277) | `Les prochaines dates pour les balades, cours et mantrailing !` | `Les prochaines dates pour les cours collectifs, stages et mantrailing !` |
| 11 | Carte activité (L288) | `Cours & Balades Collectives` | `Cours Collectifs` |
| 12 | Bouton filtre (L329) | `<button class="filter-btn" data-filter="balade">Balades</button>` | supprimé + **ajout** `<button class="filter-btn" data-filter="stage">Stages</button>` |
| 13 | CSS `.event-type-stage` | existe déjà (violet) | conservé, utilisé par le nouveau filtre |

### 2. `tarifs.html`

| # | Élément | Avant | Après |
|---|---------|-------|-------|
| 1 | meta description (L17) | `...Pension dès 25€/jour. Balades collectives 15€. Forfaits...` | `...Pension dès 25€/jour. Forfaits avantageux...` |
| 2 | og:description (L39) | `...pension familiale, balades et mantrailing.` | `...pension familiale et mantrailing.` |
| 3 | Carte tarif (L293) | `Cours / Balade collective` (15 €) | `Cours collectif` (15 €) |

### 3. `admin/index.php`

| # | Élément | Avant | Après |
|---|---------|-------|-------|
| 1 | Option type (L152) | `<option value="balade">Balade</option>` | supprimée |
| 2 | Placeholder titre (L147) | `Ex: Balade Collective - Schirmeck` | `Ex: Cours Collectif - Schirmeck` |
| 3 | Image auto (L24) | `$_POST['type'] === 'balade' ? 'assets/images/collectif-main.webp' : 'assets/images/collectif-side.webp'` | `'assets/images/collectif-side.webp'` (image fixe, plus de cas balade) |

### 4. `index.html`

| # | Élément | Avant | Après |
|---|---------|-------|-------|
| 1 | meta description (L27) | `...pension familiale, balades collectives et mantrailing.` | `...pension familiale et mantrailing.` |
| 2 | meta keywords (L29) | retire `balades collectives chiens,` | sans balade |
| 3 | og:description (L71) | `...pension familiale et balades collectives.` | `...pension familiale et mantrailing.` |
| 4 | twitter:description (L87) | idem L71 | idem |
| 5 | JSON-LD description (L110) | `...pension familiale, balades collectives et mantrailing.` | `...pension familiale et mantrailing.` |
| 6 | Bandeau services (L323) | `Cours/Balade Collective` | `Cours Collectif` |

## Hors périmètre (inchangés)

- `assets/events.json` : aucune donnée `balade` en local (vérifié ++) ni en ligne (vérifié : types `cours`/`stage` seulement). **Aucune modification** — attention à ne pas écraser le fichier live lors du déploiement.
- `pension.html` : « balades en forêt » et « Option Balade Forêt +5 €/jour » = prestation **pension**, pas le service collectif. Conservé.
- `conseils.html` : « La vraie balade » = article de conseil (état « en construction »), pas le service payant. Conservé.
- `cgv.html` : mention générique d'accompagnement en balade (contexte pension/copie). Conservé.
- `style.css` : aucune règle `.balade` globale (le style est inline dans planning.html). Vérifié.
- `main.js` : aucun traitement « balade » (badge généré depuis `event.type`). Vérifié — la logique JS reste compatible (filtre `balade` simplement absent si plus d'événements de ce type).

## 5. `conseils.html` + `cgv.html` — nettoyage keywords SEO

| # | Fichier | Élément | Avant | Après |
|---|---------|---------|-------|-------|
| 1 | `conseils.html` L11 | meta keywords | `...balades collectives, mantrailing...` | `...mantrailing...` (retrait `balades collectives,`) |
| 2 | `cgv.html` L10 | meta keywords | `...balades collectives, mantrailing...` | `...mantrailing...` (retrait `balades collectives,`) |

## 6. Docs — mise à jour types événements

| Fichier | Changement |
|---------|------------|
| `AGENTS.md` L79-84 (tableau types) | Retirer ligne `balade` ; conserver `cours`, `mantrailing`, `stage` |
| `STRUCTURE.md` L70 (exemple JSON) | Exemple `balade` → changer en `stage` (ou `cours`) |
| `features.md` L15 (planning) | `filtres par type (balade/cours/mantrailing/stage)` → `(cours/mantrailing/stage)` |

## 7. `assets/events.old` — suppression

Fichier untracked, ancien planning avec balades. **Supprimer** (`rm assets/events.old`).

## Critères de réussite

1. `grep -i "balade"` sur `planning.html`, `tarifs.html`, `admin/index.php`, `index.html`, `conseils.html`, `cgv.html` → **0 occurrence** (hors périmètre pension.html).
2. La page planning affiche : « Cours Collectifs », « Stages » et « Mantrailing » dans les cartes + filtres « Tout / Cours Collectifs / Stages / Mantrailing ».
3. L'admin ne propose plus « Balade » dans le type d'événement.
4. Aucune modification de `assets/events.json`, `.htaccess`, CSS global, JS.
5. Rendu visuel vérifié (Live Server) : planning, tarifs, accueil, admin.
6. Docs à jour (AGENTS.md, STRUCTURE.md, features.md).
7. `assets/events.old` absent.

## Déploiement

- FTP → `public_html/` : fichiers modifiés (`planning.html`, `tarifs.html`, `admin/index.php`, `index.html`, `conseils.html`, `cgv.html`).
- **Ne pas** transférer `assets/events.json` (source de vérité = fichier live).
- Git : commit + push des fichiers modifiés + suppression `assets/events.old` + spec. Pas de secrets (aucun fichier sensible touché).