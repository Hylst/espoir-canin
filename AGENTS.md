# AGENTS.md — Espoir Canin

## Project Overview

Static HTML/CSS/JS website for Espoir Canin (dog training business, Natzwiller, France). No framework, no bundler, no build step — just static files served by Apache on LWS hosting.

- **Production**: https://espoir-canin.fr/
- **Stack**: HTML5, CSS3, vanilla JS, PHP (admin panel + contact form), Node.js (Vercel serverless)
- **Contact form**: PHP/PHPMailer (`contact_process.php`, gitignored). A Vercel serverless function (`api/contact.js`) also exists but is NOT wired to the frontend.

## Key Commands

No build/test/lint commands. Static site.

- **Local dev**: `php -S localhost:8000` (needed for PHP admin/contact). Live Server works for static pages.
- **Admin panel**: `https://espoir-canin.fr/admin/` (password in `admin/auth.php`)

## Architecture

```
/
├── index.html, services.html, ...   # Static HTML pages (no templating)
├── assets/
│   ├── css/style.css                # Single stylesheet, CSS variables in :root
│   ├── js/main.js                   # Vanilla JS (mobile menu, scroll reveal, header)
│   ├── images/                      # 27 WebP images
│   └── events.json                  # Event data for planning page
├── admin/                           # PHP admin panel (CRUD events)
│   └── auth.php                     # Session-based auth (plaintext password, gitignored)
├── api/
│   └── contact.js                   # Vercel serverless (Nodemailer, orphan — not called from HTML)
├── .htaccess                        # Apache: HTTPS, gzip, cache, security headers
├── features.md                      # Feature list
└── AGENTS.md                        # This file
```

## Critical Files

- **`assets/css/style.css`** — All design tokens in `:root`. Modify to change colors/typography globally.
- **`assets/events.json`** — Event data for `planning.html`. Fields: `{ id, title, date, time, type, description, image }`. Event types: `balade`, `cours`, `mantrailing`, `stage`.
- **`admin/auth.php`** — Admin password in plaintext. Gitignored. Do not commit.
- **`.htaccess`** — Apache config: HTTPS redirect, gzip, cache, security headers.

## Sensitive / Gitignored Files

- `admin/auth.php`, `admin/config.php` — Admin credentials
- `contact_process.php` — PHPMailer config with SMTP passwords
- `.env`, `node_modules/`

## Deployment

- **Static files + PHP**: LWS shared hosting (Apache). Push to `main` → deploy manually or via FTP.
- **API (orphan)**: `api/contact.js` deploys automatically to Vercel from GitHub, but frontend doesn't call it.
- No CI/CD pipeline.

## Conventions

- **Language**: French. HTML `lang="fr"`.
- **CSS**: Use variables from `:root`. Key vars: `--color-primary` (#59d600), `--color-bg-dark`, `--color-surface`.
- **Images**: WebP format. Lazy loading via `loading="lazy"`.
- **Responsive**: Breakpoints at 768px (mobile) and 992px (desktop). Mobile menu uses `.is-open` toggle.
- **Vanilla JS only**: DOM via `querySelector`/`querySelectorAll`. No frameworks.
- **Event types**: Only `balade`, `cours`, `mantrailing`, `stage`. Each has a specific badge color + default image.

## Gotchas

- `data/events.json` does NOT exist (removed from git). `assets/events.json` is the single source of truth.
- `api/contact.js` (Vercel/Nodemailer) has hardcoded Gmail credentials but is NOT called from `contact.html` — the form submits to `contact_process.php` (PHP/PHPMailer). The Vercel function is orphan code.
- CSS has formatting inconsistencies: some inline comments were moved to separate lines by an auto-formatter (unstaged changes in working tree).
- `.htaccess` blocks `send_mail.php` and dotfiles. JSON/MD files explicitly allowed.
- `conseils.html` is listed as "en construction" — likely incomplete.
- `package.json` lists `nodemailer` (for Vercel) and `sharp` (no current usage found).
