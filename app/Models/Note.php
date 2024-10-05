<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class Note extends Model {
  use HasFactory;

  protected $fillable = ['title', 'content'];

  /**
   * Get the users that own the note.
   */
  public function user(): BelongsTo {
    return $this->belongsToMany(User::class, 'note_user', 'note_id', 'user_id');
  }

}
