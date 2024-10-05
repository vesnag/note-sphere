<?php

namespace App\Providers;

use App\Models\Note;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

/**
 *
 */
class BroadcastServiceProvider extends ServiceProvider {

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {
    Broadcast::routes();

    // Define the authorization logic for the presence channel.
    Broadcast::channel('note-sphere-broadcasting.{noteId}', function ($user, $noteId) {
        // Fetch the note.
       $note = Note::find($noteId);

      // Check if the user is associated with the note.
      if ($note && $note->users->contains($user->id)) {
          Log::info("User {$user->id} is authorized to view note {$noteId}");

          return ['id' => $user->id, 'name' => $user->name, 'profile_picture' => $user->profile_picture];
      }

    });
  }

}
