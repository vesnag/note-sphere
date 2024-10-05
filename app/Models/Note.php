<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Note extends Model {
  use HasFactory;

  protected $fillable = ['title', 'content'];

  /**
   * The users that belong to the note.
   */
  public function users(): BelongsToMany {
    return $this->belongsToMany(User::class, 'note_user', 'note_id', 'user_id');
  }

}
