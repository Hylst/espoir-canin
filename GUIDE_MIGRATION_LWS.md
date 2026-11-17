# Guide de Migration : Vercel vers LWS (Hébergement Mutualisé)

Ce guide t'explique comment migrer le site web "Espoir Canin" de Vercel vers l'hébergement LWS.

## Prérequis
- Codes d'accès **LWS** (Panel client).
- Un logiciel FTP (ex: [FileZilla](https://filezilla-project.org/)).
- Les identifiants FTP fournis par LWS (Hôte, Identifiant, Mot de passe).

## Étape 1 : Préparer les fichiers
Les fichiers du site sont prêts dans le dossier local `EspoirCaninv2`.
Assure-toi que le dossier `admin` et le fichier `assets/events.json` sont bien présents.

## Étape 2 : Connexion FTP
1. Ouvre FileZilla.
2. Entre les informations de connexion LWS :
   - **Hôte** : `ftp.espoir-canin.fr` (ou l'IP `83.229.19.69`).
   - **Identifiant** : ton identifiant LWS.
   - **Mot de passe** : ton mot de passe FTP.
3. Clique sur "Connexion rapide".
4. Dans la fenêtre de droite (Serveur), va dans le dossier `public_html` ou `www`. C'est la racine du site.
5. Supprime les éventuels fichiers par défaut (ex: `default.php` ou fichiers WordPress restants).

## Étape 3 : Envoyer les fichiers
1. Dans la fenêtre de gauche (Ton ordinateur), navigue vers le dossier `EspoirCaninv2`.
2. Sélectionne **tous les fichiers et dossiers** SAUF :
   - `.git` (dossier caché)
   - `node_modules` (lourd et inutile)
   - `.gitignore`
   - Les fichiers `.md` (guides, readme, etc.)
   - Le `events.json` de la racine (inutilisé)
   - `admin/auth.php` et `contact_process.php` s'ils n'ont pas été modifiés volontairement
   - `assets/events.json` si le site est déjà en ligne : la production est la source de vérité.
3. Fais un clic droit -> "Envoyer".
4. Attends que le transfert soit terminé.

## Étape 4 : Permissions (Important pour le Planning)
Pour pouvoir ajouter/supprimer des événements via l'administration, le fichier contenant les événements doit être modifiable par le site.
1. Dans FileZilla (côté serveur à droite), va dans le dossier `assets`.
2. Fais un clic droit sur `events.json` -> "Droits d'accès au fichier..." (ou Permissions).
3. Entre la valeur numérique **666** ou **644**.
   - Coche "Écriture" pour le "Propriétaire".
   - Si ça ne marche pas, essaie 666 (Lecture/Écriture pour tous).

## Étape 5 : Configuration du Domaine (DNS)
Tu dois faire pointer le domaine vers ton hébergement LWS (et plus vers Vercel).
1. Connecte-toi à ton [Panel Client LWS](https://panel.lws.fr/).
2. Va dans la gestion du domaine `espoir-canin.fr` -> **Zone DNS**.
3. Repère la ligne de Type **A** avec le nom **@** (c'est la première ligne).
   - Actuellement, elle pointe probablement vers `216.198.79.1` (Vercel/autre).
4. Clique sur le crayon pour modifier.
5. Remplace la valeur par l'IP de ton hébergement LWS (indiquée en haut en bleu) : **`83.229.19.69`**.
6. Sauvegarde.
7. (Optionnel) Vérifie que la ligne `www` est un CNAME qui pointe vers `@` (c'est le cas par défaut), donc tout est bon.

La propagation peut prendre jusqu'à 24h, mais c'est souvent très rapide (moins d'une heure).

## Étape 6 : Test
Va sur `https://espoir-canin.fr`.
- Vérifie que le site s'affiche.
- Teste l'administration : `https://espoir-canin.fr/admin` (mot de passe défini dans `admin/auth.php`).
- Teste le formulaire de contact (envoie un email test).

## Étape 7 : Configuration des Emails (SMTP)
Le formulaire utilise `contact_process.php` (fichier non versionné, présent en local et sur le serveur). Il tente d'abord le SMTP LWS (`mail.espoir-canin.fr`), puis bascule sur Gmail si l'envoi échoue.

Pour modifier les identifiants :
1. Connecte-toi à ton Panel LWS et crée l'adresse email si ce n'est pas déjà fait.
2. Ouvre `contact_process.php` et modifie les blocs SMTP LWS et/ou Gmail :
   - `$mail->Host`
   - `$mail->Username`
   - `$mail->Password`
   - `$mail->setFrom`
3. Enregistre et renvoie le fichier sur le serveur FTP.
4. Teste le formulaire de contact avec un vrai envoi.

⚠️ Ne jamais committer `contact_process.php` : il contient les mots de passe SMTP.

