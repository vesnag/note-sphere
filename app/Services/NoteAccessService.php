<?php

namespace App\Services;

use App\Models\Note;

/**
 * Service for note access.
 */
class NoteAccessService {

  /**
   * Check if a user can view the note.
   */
  public function hasUserAccessToNote(?Note $note, int $userId): bool {
    if ($note === NULL) {
      return FALSE;
    }
    return $note->users->contains($userId);
  }

}
