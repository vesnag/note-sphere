<?php

use App\Models\Note;
use App\Services\NoteAccessService;
use Illuminate\Support\Facades\Broadcast;

define('DEFAULT_PROFILE_PICTURE', asset('default-profile-picture.jpg'));

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('note-sphere-broadcasting.{noteId}',

function ($user, $noteId): array | bool {
  $noteAccessService = App::make(NoteAccessService::class);
  $note = Note::with('users')->find($noteId);

  if (FALSE === $noteAccessService->hasUserAccessToNote($note, $user->id)) {
    return FALSE;
  }

  return [
    'user_id' => $user->id,
    'user_info' => [
      'user_id' => $user->id,
      'name' => $user->name,
      'profile_picture' => $user->profile_picture ? asset('storage/' . $user->profile_picture) : DEFAULT_PROFILE_PICTURE,
    ],
  ];

});
