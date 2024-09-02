import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('dark-mode-toggle');
    const darkModeIcon = document.getElementById('theme-toggle-dark-icon');
    const lightModeIcon = document.getElementById('theme-toggle-light-icon');

    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
        darkModeIcon.classList.remove('hidden');
        lightModeIcon.classList.add('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        darkModeIcon.classList.add('hidden');
        lightModeIcon.classList.remove('hidden');
    }

    toggleButton.addEventListener('click', function () {
        document.documentElement.classList.toggle('dark');
        if (document.documentElement.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
            darkModeIcon.classList.remove('hidden');
            lightModeIcon.classList.add('hidden');
        } else {
            localStorage.setItem('theme', 'light');
            darkModeIcon.classList.add('hidden');
            lightModeIcon.classList.remove('hidden');
        }
    });
});
