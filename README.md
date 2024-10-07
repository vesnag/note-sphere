## NoteSphere
This project was started to learn about **WebSockets** and **Laravel**. **NoteSphere** is a collaborative note-taking app where notes can be created, shared, and edited in real-time. This app is a work in progress, showing a journey of learning and trying out new things.

<img width="280" alt="noteSphere1" src="https://github.com/user-attachments/assets/4ff2da17-af1e-4212-81ca-ac5354b7f9dc">

### Real-Time Collaboration
NoteSphere is built for real-time editing, thanks to Laravel Echo and Pusher. When multiple people edit the same note, everyone sees updates instantly

<img width="453" alt="noteSphere2" src="https://github.com/user-attachments/assets/46bae3f1-e94a-4f79-be58-c93d05dfdfa8">
<img width="397" alt="noteSphere3" src="https://github.com/user-attachments/assets/51370767-b3f8-408b-8316-d1e14c1d559c">

\
Make sure to add your Pusher keys in the `.env` file:

```plaintext
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_APP_CLUSTER=your_app_cluster

VITE_PUSHER_APP_ID=your_app_id
VITE_PUSHER_APP_KEY=your_app_key
VITE_PUSHER_APP_SECRET=your_app_secret
VITE_PUSHER_APP_CLUSTER=your_app_cluster
```

### Technologies
- **Backend:** Laravel
- **Frontend:** Tailwind CSS, Alpine.js
- **Real-time Features:** Laravel Echo, Pusher
- **Authentication:** Laravel Breeze
- **Database:** MySQL

### TODO
- Review the code.
- Write a command or add a user interface to assign users to notes.
- Write a command or add a user interface to generate a link for automatic login (autologin) for users.

### Note
Since this is my first time working with Laravel, I tried to follow good practices from the helpful article [Mindtwo Laravel Coding Guidelines](https://www.mindtwo.com/guidelines/coding/laravel).
