<?php

namespace App\Http\Middleware;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;


class CheckNoteUser {

  /**
   * Handle an incoming request.
   */
  public function handle(Request $request, \Closure $next): RedirectResponse|Response {
    $noteId = $request->route('id');
    $note = Note::with('users')->find($noteId);

    if (!$note || !$note->users->contains(Auth::id())) {
      return redirect()->route('dashboard')->with('error', 'You do not have access to this note.');
    }

    return $next($request);
  }

}
