document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.querySelector('#menu-toggle');
    const navMenu = document.querySelector('nav');

    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    }
});
