<?php

namespace App\Http\Middleware;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class CheckNoteUser {

  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure $next
   *
   * @return mixed
   */
  public function handle(Request $request, \Closure $next) {
    $noteId = $request->route('id') ?? NULL;
    $note = Note::with('users')->find($noteId);

    if ($note && $note->users->contains(Auth::id())) {
      return $next($request);
    }

    return redirect()->route('dashboard')->with('error', 'You do not have access to this note.');
  }

}
