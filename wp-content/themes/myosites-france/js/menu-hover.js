/**
 * Menu Multi-niveaux - Hover sur desktop, clic sur mobile
 */
(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar');
        if (!navbar) return;

        const isMobile = () => window.innerWidth < 992;

        // Fonction pour ouvrir un dropdown
        function openDropdown(dropdown) {
            dropdown.classList.add('show');
            const menu = dropdown.querySelector(':scope > .dropdown-menu');
            if (menu) menu.classList.add('show');
        }

        // Fonction pour fermer un dropdown et ses enfants
        function closeDropdown(dropdown) {
            dropdown.classList.remove('show');
            const menu = dropdown.querySelector(':scope > .dropdown-menu');
            if (menu) {
                menu.classList.remove('show');
                // Fermer aussi les sous-dropdowns
                menu.querySelectorAll('.dropdown.show').forEach(function(sub) {
                    closeDropdown(sub);
                });
            }
        }

        // Fermer tous les dropdowns
        function closeAllDropdowns() {
            navbar.querySelectorAll('.dropdown.show').forEach(function(dropdown) {
                closeDropdown(dropdown);
            });
        }

        // DESKTOP : Hover
        if (!isMobile()) {
            navbar.querySelectorAll('.dropdown').forEach(function(dropdown) {
                dropdown.addEventListener('mouseenter', function(e) {
                    // Fermer les siblings
                    const siblings = this.parentElement.querySelectorAll(':scope > .dropdown.show');
                    siblings.forEach(function(sibling) {
                        if (sibling !== dropdown) closeDropdown(sibling);
                    });
                    openDropdown(this);
                });

                dropdown.addEventListener('mouseleave', function(e) {
                    closeDropdown(this);
                });
            });

            // Permettre le clic sur les liens parents (navigation)
            navbar.querySelectorAll('.dropdown-toggle').forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    // Si le lien a un href valide (pas # ou vide), on navigue
                    const href = this.getAttribute('href');
                    if (href && href !== '#' && href !== '') {
                        // Laisser la navigation se faire
                        return true;
                    }
                    e.preventDefault();
                });
            });
        }

        // MOBILE : Clic
        if (isMobile()) {
            navbar.querySelectorAll('.dropdown-toggle').forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const dropdown = this.parentElement;
                    const isOpen = dropdown.classList.contains('show');

                    // Fermer les siblings du même niveau
                    const siblings = dropdown.parentElement.querySelectorAll(':scope > .dropdown');
                    siblings.forEach(function(sibling) {
                        if (sibling !== dropdown) closeDropdown(sibling);
                    });

                    // Toggle
                    if (isOpen) {
                        closeDropdown(dropdown);
                    } else {
                        openDropdown(dropdown);
                    }
                });
            });
        }

        // Fermer au clic à l'extérieur
        document.addEventListener('click', function(e) {
            if (!navbar.contains(e.target)) {
                closeAllDropdowns();
            }
        });
    });
})();
