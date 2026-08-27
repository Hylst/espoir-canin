# Retrait service « balade » — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Retirer le service « balade collective » du site (planning, tarifs, accueil, admin) + intégrer les stages dans le planning + nettoyage transverses (keywords, docs, fichier obsolète).

**Architecture:** Site statique HTML/CSS/JS + PHP admin. 7 fichiers à modifier, 1 fichier à supprimer. Pas de build, pas de tests automatisés. Vérification visuelle via Live Server (`php -S localhost:8000` pour PHP).

**Tech Stack:** HTML5, CSS3, vanilla JS, PHP 8.x, Apache/LWS

---

## Global Constraints

- **Ne pas modifier** `assets/events.json` (source de vérité = fichier live sur LWS)
- **Ne pas toucher** `pension.html` (balades en forêt = prestation pension, pas service collectif)
- **Ne pas toucher** `.htaccess`, `style.css` global, `main.js` (pas de code « balade » dedans)
- **Images** : garder `collectif-main.webp` et `collectif-side.webp` (utilisées ailleurs)
- **Déploiement** : FTP manuel vers `public_html/` LWS après validation locale

---

### Task 1: `planning.html` — Retrait balade + ajout stages

**Files:**
- Modify: `planning.html`

**Interfaces:** Aucune (fichier standalone)

- [ ] **Step 1: Modifier les metas SEO + titres (head)**
  - L7 commentaire : `Calendrier des balades et cours collectifs` → `Calendrier des cours collectifs, stages et mantrailing`
  - L15 `<title>` : `Planning Balades & Cours Collectifs | ...` → `Planning Cours Collectifs, Stages & Mantrailing | ...`
  - L16-17 meta description : retirer « balades collectives, », ajouter « stages et »
  - L18-19 meta keywords : retirer `balade collective chien Alsace,` et `balades canines Schirmeck,`, ajouter `stage chien Alsace,`
  - L37 og:title : `Planning Balades & Cours Collectifs...` → `Planning Cours Collectifs, Stages & Mantrailing...`
  - L38-39 og:description : retirer « balades, », ajouter « stages et »
  - L48 twitter:title : idem og:title
  - L49 twitter:description : idem og:description

- [ ] **Step 2: Supprimer CSS `.event-type-balade` (L200-204)**
  - Supprimer tout le bloc `.event-type-balade { ... }`

- [ ] **Step 3: Modifier Hero (L276-277)**
  - `Les prochaines dates pour les balades, cours et mantrailing !` → `Les prochaines dates pour les cours collectifs, stages et mantrailing !`

- [ ] **Step 4: Modifier carte activité (L288)**
  - `Cours & Balades Collectives` → `Cours Collectifs`

- [ ] **Step 5: Modifier filtres (L327-332)**
  - Supprimer `<button class="filter-btn" data-filter="balade">Balades</button>`
  - Ajouter `<button class="filter-btn" data-filter="stage">Stages</button>` après le bouton Cours
  - Ordre final : `Tout / Cours Collectifs / Stages / Mantrailing`

- [ ] **Step 6: Vérifier visuellement (Live Server)**
  - Ouvrir `planning.html` → confirmer : pas de mot « balade », filtre Stages présent, badges violets pour stages

---

### Task 2: `tarifs.html` — Retrait balade

**Files:**
- Modify: `tarifs.html`

**Interfaces:** Aucune

- [ ] **Step 1: Modifier meta description (L17)**
  - `...Pension dès 25€/jour. Balades collectives 15€. Forfaits...` → `...Pension dès 25€/jour. Forfaits avantageux...`

- [ ] **Step 2: Modifier og:description (L39)**
  - `...pension familiale, balades et mantrailing.` → `...pension familiale et mantrailing.`

- [ ] **Step 3: Modifier carte tarif (L293)**
  - `Cours / Balade collective` → `Cours collectif`

- [ ] **Step 4: Vérifier visuellement**
  - Ouvrir `tarifs.html` → section « Collectifs & Loisirs » : une seule carte à 15 € libellée « Cours collectif »

---

### Task 3: `admin/index.php` — Retrait option balade

**Files:**
- Modify: `admin/index.php`

**Interfaces:** Aucune

- [ ] **Step 1: Supprimer option select (L152)**
  - Supprimer `<option value="balade">Balade</option>`
  - Garder `cours`, `mantrailing`, `stage`

- [ ] **Step 2: Modifier placeholder titre (L147)**
  - `Ex: Balade Collective - Schirmeck` → `Ex: Cours Collectif - Schirmeck`

- [ ] **Step 3: Simplifier image auto (L24)**
  - Remplacer `$_POST['type'] === 'balade' ? 'assets/images/collectif-main.webp' : 'assets/images/collectif-side.webp'`
  - Par `'assets/images/collectif-side.webp'` (fixe)

- [ ] **Step 5: Test admin (nécessite PHP)**
  - Lancer `php -S localhost:8000`
  - Aller sur `http://localhost:8000/admin/` → login → vérifier select type : 3 options (cours, mantrailing, stage)
  - Ajouter un événement test → vérifier image par défaut = `collectif-side.webp`

---

### Task 4: `index.html` — Retrait balade (SEO + bandeau)

**Files:**
- Modify: `index.html`

**Interfaces:** Aucune

- [ ] **Step 1: Modifier meta description (L27)**
  - `...pension familiale, balades collectives et mantrailing.` → `...pension familiale et mantrailing.`

- [ ] **Step 2: Modifier meta keywords (L29)**
  - Retirer `balades collectives chiens,`

- [ ] **Step 3: Modifier og:description (L71)**
  - `...pension familiale et balades collectives.` → `...pension familiale et mantrailing.`

- [ ] **Step 4: Modifier twitter:description (L87)**
  - Idem L71

- [ ] **Step 5: Modifier JSON-LD description (L110)**
  - `...pension familiale, balades collectives et mantrailing...` → `...pension familiale et mantrailing.`

- [ ] **Step 6: Modifier bandeau services (L323)**
  - `Cours/Balade Collective` → `Cours Collectif`

- [ ] **Step 7: Vérifier visuellement**
  - Ouvrir `index.html` → vérifier bandeau services + aucun « balade » dans les metas

---

### Task 5: `conseils.html` + `cgv.html` — Nettoyage keywords SEO

**Files:**
- Modify: `conseils.html` (L11)
- Modify: `cgv.html` (L10)

**Interfaces:** Aucune

- [ ] **Step 1: conseils.html L11 meta keywords**
  - `...balades collectives, mantrailing...` → `...mantrailing...` (retrait `balades collectives,`)

- [ ] **Step 2: cgv.html L10 meta keywords**
  - `...balades collectives, mantrailing...` → `...mantrailing...` (retrait `balades collectives,`)

---

### Task 6: Docs — Mise à jour types événements

**Files:**
- Modify: `AGENTS.md` (tableau types L79-84)
- Modify: `STRUCTURE.md` (exemple JSON L70)
- Modify: `features.md` (L15 planning)

**Interfaces:** Aucune

- [ ] **Step 1: AGENTS.md**
  - Tableau types : supprimer ligne `balade` | Vert | Balades éducatives en groupe
  - Conserver `cours`, `mantrailing`, `stage`

- [ ] **Step 2: STRUCTURE.md**
  - L70 exemple JSON : changer `"type": "balade"` → `"type": "stage"` (ou `cours`)

- [ ] **Step 3: features.md**
  - L15 : `filtres par type (balade/cours/mantrailing/stage)` → `filtres par type (cours/mantrailing/stage)`

---

### Task 7: Supprimer `assets/events.old`

**Files:**
- Delete: `assets/events.old`

**Interfaces:** Aucune

- [ ] **Step 1: Supprimer le fichier**
  - `Remove-Item D:\0CODE\AntiGravity\EspoirCaninv2\assets\events.old`

---

### Task 8: Validation globale + commit + déploiement

**Files:** Tous les fichiers modifiés

- [ ] **Step 1: Vérification grep finale**
  - `grep -ri "balade" planning.html tarifs.html admin/index.php index.html conseils.html cgv.html`
  - Résultat attendu : 0 occurrence

- [ ] **Step 2: Vérification visuelle complète (Live Server)**
  - `php -S localhost:8000`
  - Pages : `index.html`, `planning.html`, `tarifs.html`, `admin/`, `conseils.html`, `cgv.html`
  - Vérifier cohérence textes, filtres planning, admin select

- [ ] **Step 3: Git commit**
  - `git add planning.html tarifs.html admin/index.php index.html conseils.html cgv.html AGENTS.md STRUCTURE.md features.md`
  - `git rm assets/events.old`
  - `git commit -m "feat: retrait service balade + intégration stages + nettoyage cohérence"`
  - `git push`

- [ ] **Step 4: Déploiement FTP**
  - Transférer vers `public_html/` : `planning.html`, `tarifs.html`, `admin/index.php`, `index.html`, `conseils.html`, `cgv.html`, `AGENTS.md`, `STRUCTURE.md`, `features.md`
  - **NE PAS** transférer `assets/events.json`
  - Tester sur `https://espoir-canin.fr/planning.html`, `/tarifs.html`, `/admin/`