<?php

namespace App\Http\Controllers;

use App\Events\NoteUpdated;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class NoteController extends Controller {

  /**
   * Show the editor with an existing note or a new one.
   */
  public function show(?int $id = NULL): View {
    $note = $id ? Note::findOrFail($id) : NULL;
    return view('notes.editor', compact('note'));
  }

  /**
   * Store a new note.
   */
  public function store(Request $request): RedirectResponse {
    $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
    ]);

    $note = Note::create([
      'title' => $request->title,
      'content' => $request->content,
    ]);

    $user = Auth::user();
    $user->notes()->attach($note->id);

    return redirect()->route('note.show.single', $note->id);
  }

  /**
   * Update an existing note.
   */
  public function update(Request $request, int $id): RedirectResponse {
    $note = Note::findOrFail($id);

    $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
    ]);

    $note->update([
      'title' => $request->title,
      'content' => $request->content,
    ]);

    $user = Auth::user();
    if (!$user->notes->contains($note->id)) {
      $user->notes()->attach($note->id);
    }

    Log::info("Note updated: $note->id and broadcasted.");
    broadcast(new NoteUpdated($note->id, $note->content))->toOthers();

    return redirect()->route('note.show.single', $note->id);
  }

}
