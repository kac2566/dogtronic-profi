/**
 * Frontend logic for Header Block.
 */
document.addEventListener('DOMContentLoaded', () => {
    const headers = document.querySelectorAll('.sf-header');

    headers.forEach(header => {
        const toggle = header.querySelector('.js-header-toggle');
        const menu = header.querySelector('.js-header-mobile-menu');

        if (!toggle || !menu) return;

        const toggleMenu = (show) => {
            const isExpanded = show !== undefined ? show : toggle.getAttribute('aria-expanded') === 'true';

            if (isExpanded) {
                // Close menu
                toggle.setAttribute('aria-expanded', 'false');
                menu.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            } else {
                // Open menu
                toggle.setAttribute('aria-expanded', 'true');
                menu.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            }
        };

        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleMenu();
        });

        // Close menu on resize if above mobile breakpoint
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                if (toggle.getAttribute('aria-expanded') === 'true') {
                    toggleMenu(true); // Close it
                }
            }
        });

        // Close menu if clicking outside the menu drawer
        document.addEventListener('click', (e) => {
            if (toggle.getAttribute('aria-expanded') === 'true') {
                if (!menu.contains(e.target) && !toggle.contains(e.target)) {
                    toggleMenu(true); // Close it
                }
            }
        });
    });
});
