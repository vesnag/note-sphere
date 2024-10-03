<?php

namespace App\Http\Controllers;

use App\Events\NoteUpdated;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 *
 */
class NoteController extends Controller {

  /**
   * Show the editor with an existing note or a new one.
   */
  public function show($id = NULL) {
    $note = $id ? Note::findOrFail($id) : NULL;
    return view('notes.editor', compact('note'));
  }

  /**
   * Store a new note.
   */
  public function store(Request $request) {
    // @todo create validator.
    $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
    ]);

    $note = Note::create([
      'title' => $request->title,
      'content' => $request->content,
    ]);

    return redirect()->route('note.show', $note->id);
  }

  /**
   * Update an existing note.
   */
  public function update(Request $request, $id) {
    $note = Note::findOrFail($id);

    // @todo create validator.
    $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
    ]);

    $note->update([
      'title' => $request->title,
      'content' => $request->content,
    ]);

    Log::info("Note updated: $note->id and broadcasted.");
    // Broadcast the note update.
    broadcast(new NoteUpdated($note->id, $note->content))->toOthers();

    return redirect()->route('note.show', $note->id);
  }

}
