<?php

namespace App\Providers;

use App\Models\Note;
use Illuminate\Support\Facades\Broadcast;
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

    require base_path('routes/channels.php');

    Broadcast::channel('note.{noteId}', function ($user, $noteId) {
      $note = Note::find($noteId);

      if (!$note instanceof Note) {
            return FALSE;
      }

      return $note->users->contains($user);
    });
  }

}
