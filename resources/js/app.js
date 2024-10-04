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


  const path = window.location.pathname;
  const nodeRegex = /^\/note\/\d+$/;

  const noteId = 1;

  if (nodeRegex.test(path)) {

    console.log('DOM loaded with JavaScript');

    window.Echo.channel(`note-sphere-broadcasting.${noteId}`)


    // Subscribe to the presence channel
    window.Echo.join(`note-sphere-broadcasting.${noteId}`)
      .here((users) => {
        console.log('Users currently in the channel:', users);
        updateUsersList(users);
      })
      .joining((user) => {
        console.log(`User joined: ${user.name}`);
        addUserToList(user);
      })
      .leaving((user) => {
        console.log(`User left: ${user.name}`);
        removeUserFromList(user);
      })
      .listen('NoteUpdated', (event) => {
        console.log('Note updated:', event);
        console.log(event.content);
        document.getElementById('note-content').value = event.content;
      });

    // Function to update the list of users currently in the channel
    function updateUsersList(users) {
      const usersList = document.getElementById('users-list');
      usersList.innerHTML = ''; // Clear the list
      users.forEach(user => {
        const userItem = document.createElement('li');
        userItem.textContent = user.name;
        usersList.appendChild(userItem);
      });
    }

    // Function to add a user to the list
    function addUserToList(user) {
      const usersList = document.getElementById('users-list');
      const userItem = document.createElement('li');
      userItem.textContent = user.name;
      userItem.id = `user-${user.id}`;
      usersList.appendChild(userItem);
    }

    // Function to remove a user from the list
    function removeUserFromList(user) {
      const userItem = document.getElementById(`user-${user.id}`);
      if (userItem) {
        userItem.remove();
      }
    }

  }
});
