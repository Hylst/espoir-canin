# Guide de Gestion du Planning

Ce guide t'explique comment ajouter ou supprimer des dates sur la page Planning du site, sans toucher au code.

## Accéder à l'administration

1. Ouvre ton navigateur internet.
2. Va à l'adresse : `https://espoir-canin.fr/admin`
3. Entre le mot de passe défini dans le fichier `admin/auth.php` (fichier non versionné, présent en local et sur le serveur).

## Ajouter un événement / une date

1. Une fois connecté, tu verras le formulaire **"Ajouter un événement"**.
2. Remplis les champs :
   - **Titre** : Ex: "Balade Collective - Schirmeck"
   - **Type** : Choisis dans la liste (Cours collectif, Mantrailing, Stage). Cela déterminera la couleur et l'image automatiquement.
   - **Date** : Clique sur le calendrier.
   - **Heure** : Ex: `14:00` ou `14h30 - 16h00`.
   - **Description** : Ajoute le lieu précis, le prix, et les modalités (ex: "Inscription par SMS").
3. Clique sur **"Ajouter au planning"**.
4. Un message de confirmation vert apparaîtra. L'événement est immédiatement visible sur le site.

## Supprimer un événement

1. En dessous du formulaire, tu verras la liste **"Événements à venir"**.
2. Repère la date que tu souhaites annuler ou qui est passée (les dates passées disparaissent du site public, mais restent ici pour que tu puisses les gérer).
3. Clique sur le bouton rouge **"Supprimer"**.
4. Confirme la suppression.

## Bon à savoir

- **Mise à jour automatique** : Le site affiche automatiquement les événements les plus proches en premier.
- **Dates passées** : Le site ne montre PAS les événements dont la date est passée (système automatique). Tu n'as pas besoin de les supprimer d'urgence, mais c'est bien de faire le ménage de temps en temps.

---
Si jamais tu n'arrives pas à ajouter une date, vérifie les permissions du fichier `assets/events.json` sur le serveur (ça doit être en écriture).
