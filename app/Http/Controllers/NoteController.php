<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

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

    $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
    ]);

    $note->update([
      'title' => $request->title,
      'content' => $request->content,
    ]);

    return redirect()->route('note.show', $note->id);
  }

}
