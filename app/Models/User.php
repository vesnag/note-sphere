<?php

namespace App\Models;

// Use Illuminate\Contracts\Auth\MustVerifyEmail;.
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 *
 */
class User extends Authenticatable {
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'profile_picture',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   *
   */
  public function canViewNote($noteId) {
    // Replace with your actual logic to check if the user can view the note.
    // For example, you might check if the user is the owner of the note or has been granted access.
    // s$note = Note::find($noteId);
    // return $note && $note->user_id === $this->id;.
    return TRUE;
  }

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

}
