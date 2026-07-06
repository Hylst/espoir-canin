# AGENTS.md — Espoir Canin

## Project Overview

Static HTML/CSS/JS website for Espoir Canin (dog training business, Natzwiller, France). No framework, no bundler, no build step — just static files served by Apache on LWS hosting.

- **Production**: https://espoir-canin.fr/
- **Stack**: HTML5, CSS3, vanilla JS, PHP (admin panel + contact form)
- **Contact form**: PHP/PHPMailer (`contact_process.php`, gitignored). The form submits directly, no AJAX.
- **Deployment**: FTP manual to LWS shared hosting (IP `83.229.19.69`, user `espoi1265278`). No CI/CD, no auto-deploy, no Vercel.

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
├── api/                             # Gitignored (Vercel remnant, not deployed)
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

These contain credentials and MUST never be committed:

| File | Contains |
|------|----------|
| `admin/auth.php` | Admin panel password |
| `admin/config.php` | Admin config (if any) |
| `contact_process.php` | PHPMailer SMTP config (LWS + Gmail passwords) |
| `api/contact.js` | Vercel remnant with email config |
| `.env`, `node_modules/` | Environment deps |

Credentials are managed locally and deployed to LWS via FTP. Git history has been purged of all past credential leaks (2026-07-07).

## Deployment

- **LWS shared hosting** (Apache). Deploy via FTP to `public_html/`.
- **No CI/CD**. No auto-deploy. GitHub is sync-only.
- After deploying, verify admin panel (`/admin/`) and contact form submissions work.

## Conventions

- **Language**: French. HTML `lang="fr"`.
- **CSS**: Use variables from `:root`. Key vars: `--color-primary` (#59d600), `--color-bg-dark`, `--color-surface`.
- **Images**: WebP format. Lazy loading via `loading="lazy"`.
- **Responsive**: Breakpoints at 768px (mobile) and 992px (desktop). Mobile menu uses `.is-open` toggle.
- **Vanilla JS only**: DOM via `querySelector`/`querySelectorAll`. No frameworks.
- **Event types**: Only `balade`, `cours`, `mantrailing`, `stage`. Each has a specific badge color + default image.

## Gotchas

- `data/events.json` does NOT exist. `assets/events.json` is the single source of truth.
- `admin/auth.php` must exist on LWS for the admin panel to work — it's gitignored, so FTP it separately.
- `contact_process.php` must exist on LWS for the contact form to work — also gitignored, FTP separately.
- CSS has unstaged formatting diffs (comments moved to separate lines by an auto-formatter). Harmless but noisy in `git status`.
- `.htaccess` blocks `send_mail.php` and dotfiles. JSON/MD files explicitly allowed.
- `conseils.html` is "en construction" — incomplete page.
- `package.json` + `node_modules/` are unused locally (nodemailer/sharp were for the old Vercel function).
- After credentials are rotated (Gmail app password, LWS SMTP), update both local gitignored files AND re-upload to LWS FTP.
