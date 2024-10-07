<?php

namespace App\Http\Middleware;

use App\Models\Note;
use App\Services\NoteAccessService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 *
 */
class CheckNoteUser {

  public function __construct(
    protected NoteAccessService $noteAccessService,
  ) {}

  /**
   * Handle an incoming request.
   */
  public function handle(Request $request, \Closure $next): RedirectResponse|Response {
    $user = $request->user();
    if (NULL === $user) {
      return redirect()->route('login');
    }

    $noteId = $request->route('id');
    $note = Note::with('users')->find($noteId);

    if (FALSE === $this->noteAccessService->hasUserAccessToNote($note, $user->id)) {
      return redirect()->route('dashboard')->with('error', 'You do not have access to this note.');
    }

    return $next($request);
  }

}
