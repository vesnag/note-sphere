## NoteSphere
NoteSphere is a collaborative note-taking app built with Laravel and Tailwind CSS. Users can create, share, and edit notes together in real-time.


### Real-Time Collaboration
NoteSphere is built for real-time editing, thanks to Laravel Echo and Pusher. When multiple people edit the same note, everyone sees updates instantly

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


### Note
Since this is my first time working with Laravel, I tried to follow good practices from the helpful article [Mindtwo Laravel Coding Guidelines](https://www.mindtwo.com/guidelines/coding/laravel).
