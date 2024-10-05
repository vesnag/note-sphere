import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
  const themeToggleBtn = document.getElementById('theme-toggle');
  const lightIcon = document.getElementById('theme-toggle-light-icon');
  const darkIcon = document.getElementById('theme-toggle-dark-icon');

  if (themeToggleBtn && lightIcon && darkIcon) {
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
      setTheme(isDarkMode ? 'light' : 'dark');
    });
  }

  const path = window.location.pathname;
  const noteRegex = /^\/note\/(\d+)$/;
  const match = path.match(noteRegex);
  const noteId = match ? match[1] : null;

  if (noteId) {
    window.Echo.join(`note-sphere-broadcasting.${noteId}`)
      .here(updateUsersList)
      .joining(addUserToList)
      .leaving(removeUserFromList)
      .listen('NoteUpdated', (event) => {
        document.getElementById('note-content').value = event.content;
      });

    function updateUsersList(users) {
      const usersList = document.getElementById('users-list');
      usersList.innerHTML = users.map(user => createUserListItem(user)).join('');
    }

    function addUserToList(user) {
      const usersList = document.getElementById('users-list');
      usersList.insertAdjacentHTML('beforeend', createUserListItem(user));
    }

    function removeUserFromList(user) {
      const userItem = document.getElementById(`user-${user.user_id}`);
      if (userItem) userItem.remove();
    }

    function createUserListItem(user) {
      const userInfo = user.user_info || user;
      return `
        <li id="user-${userInfo.user_id}" class="flex items-center space-x-2 p-2">
          <img src="${userInfo.profile_picture || '/default-profile-picture.jpg'}" alt="${userInfo.name}'s profile picture" class="w-8 h-8 rounded-full">
          <span>${userInfo.name}</span>
        </li>
      `;
    }
  }
});
