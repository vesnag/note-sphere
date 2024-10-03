import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
  const themeToggleBtn = document.getElementById('theme-toggle');
  const lightIcon = document.getElementById('theme-toggle-light-icon');
  const darkIcon = document.getElementById('theme-toggle-dark-icon');

  if (!themeToggleBtn || !lightIcon || !darkIcon) return;

  const setTheme = (theme) => {
    const isDark = theme === 'dark';
    document.documentElement.classList.toggle('dark', isDark);
    lightIcon.classList.toggle('hidden', !isDark);
    darkIcon.classList.toggle('hidden', isDark);
    localStorage.setItem('theme', theme);
  };

  const currentTheme = localStorage.getItem('theme') || 'light';
  setTheme(currentTheme);

  themeToggleBtn.addEventListener('click', () => {
    const isDarkMode = document.documentElement.classList.contains('dark');
    const newTheme = isDarkMode ? 'light' : 'dark';
    setTheme(newTheme);
  });
});

document.addEventListener('DOMContentLoaded', function () {
  window.Echo.channel('note-sphere-broadcasting')
    .listen('NoteUpdated', (event) => {
      console.log(event.content);
      document.getElementById('note-content').value = event.content; // Update the note content

    });
});
