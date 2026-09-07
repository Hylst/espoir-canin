/* ===========================================
   ESPOIR CANIN - Scripts JavaScript
   ============================================
   
   Site officiel : https://espoir-canin.fr/
   Éducateur canin à Natzwiller (67130), Alsace
   
   Ce fichier gère les interactions du site :
   - Menu mobile (hamburger)
   - Animations de révélation au scroll
   - Header dynamique (compact au scroll)
   
   Conception : Geoffroy Streit
   Dernière mise à jour : Janvier 2025
============================================ */

/**
 * On attend que le DOM soit complètement chargé
 * avant d'exécuter nos scripts.
 * C'est une bonne pratique pour éviter les erreurs
 * quand on essaie de manipuler des éléments pas encore présents.
 */
document.addEventListener('DOMContentLoaded', () => {

    /* -------------------------------------------
       MENU MOBILE (Hamburger)
       
       Sur les petits écrans, le menu principal
       est remplacé par un bouton hamburger.
       Au clic, on affiche/cache le menu.
    ------------------------------------------- */
    const mobileToggle = document.querySelector('.mobile-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (mobileToggle) {
        mobileToggle.addEventListener('click', () => {
            // On toggle la classe 'is-open' sur le menu
            mainNav.classList.toggle('is-open');

            // On change l'icône du bouton (hamburger ↔ croix)
            const isOpen = mainNav.classList.contains('is-open');
            mobileToggle.innerHTML = isOpen ? '✕' : '☰';

            // On met à jour l'attribut aria-expanded pour l'accessibilité
            mobileToggle.setAttribute('aria-expanded', isOpen);
        });

        // Fermer le menu quand on clique sur un lien
        const navLinks = mainNav.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                mainNav.classList.remove('is-open');
                mobileToggle.innerHTML = '☰';
                mobileToggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    /* -------------------------------------------
       SCROLL REVEAL - Animations d'apparition
       
       Les sections et cartes apparaissent avec
       une animation quand elles entrent dans
       le viewport (zone visible de l'écran).
       
       On utilise l'Intersection Observer API,
       qui est plus performante que d'écouter
       l'événement scroll.
    ------------------------------------------- */
    const revealElements = document.querySelectorAll('section, .service-card, .pension-card, .price-card, .activity-card, .event-card');

    // Vérifier si IntersectionObserver est supporté
    if ('IntersectionObserver' in window) {
        // Configuration de l'observer
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // L'élément est visible → on ajoute les classes d'animation
                    entry.target.classList.add('reveal', 'active');

                    // On arrête d'observer cet élément (animation unique)
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15, // Déclencher quand 15% de l'élément est visible
            rootMargin: '0px 0px -50px 0px' // Un peu de marge en bas
        });

        // On observe tous les éléments
        revealElements.forEach(el => {
            el.classList.add('reveal');
            revealObserver.observe(el);
        });
    } else {
        // Fallback pour les vieux navigateurs : contenu visible directement
        revealElements.forEach(el => {
            el.classList.add('active');
        });
    }

    /* -------------------------------------------
       LOGS (debug - à retirer en production)
       Juste pour vérifier que le script se charge bien
    ------------------------------------------- */
    console.log('🐕 Espoir Canin - Site chargé avec succès !');
});

/* -------------------------------------------
   HEADER DYNAMIQUE AU SCROLL
   
   Quand l'utilisateur scrolle vers le bas,
   le header devient plus compact et plus opaque.
   Ça donne un effet moderne et libère de l'espace.
------------------------------------------- */
const header = document.querySelector('.site-header');

// On vérifie que le header existe (sécurité)
if (header) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            // Scroll > 50px → header compact
            header.style.padding = '10px 0';
            header.style.background = 'rgba(2, 6, 23, 0.95)';
        } else {
            // En haut de page → header normal
            header.style.padding = '15px 0';
            header.style.background = 'rgba(2, 6, 23, 0.8)';
        }
    });
}

/* -------------------------------------------
   SMOOTH SCROLL POUR LES ANCRES
   
   Si on clique sur un lien vers une ancre (#section),
   le scroll sera fluide au lieu d'être instantané.
   
   Note : Ceci est aussi géré par CSS avec
   scroll-behavior: smooth sur html, mais
   ce script offre plus de contrôle.
------------------------------------------- */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const targetId = this.getAttribute('href');

        // On ignore les liens vides (#)
        if (targetId === '#') return;

        const targetElement = document.querySelector(targetId);

        if (targetElement) {
            e.preventDefault();

            // Scroll fluide vers l'élément cible
            targetElement.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

/* ===========================================
   FIN DU FICHIER
   
   Tu veux ajouter des fonctionnalités ?
   N'hésite pas à créer de nouvelles sections
   bien commentées comme celles ci-dessus ! 🐕
============================================ */
