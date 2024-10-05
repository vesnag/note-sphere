<?php

// app/Http/Controllers/NoteController.php.
namespace App\Http\Controllers;

use App\Events\NoteUpdated;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    // Validate the request.
    $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
    ]);

    // Create a new note.
    $note = Note::create([
      'title' => $request->title,
      'content' => $request->content,
    ]);

    // Attach the note to the authenticated user.
    $user = Auth::user();
    $user->notes()->attach($note->id);

    return redirect()->route('note.show.single', $note->id);
  }

  /**
   * Update an existing note.
   */
  public function update(Request $request, $id) {
    $note = Note::findOrFail($id);

    // Validate the request.
    $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
    ]);

    // Update the note.
    $note->update([
      'title' => $request->title,
      'content' => $request->content,
    ]);

    // Ensure the note remains associated with the authenticated user.
    $user = Auth::user();
    if (!$user->notes->contains($note->id)) {
      $user->notes()->attach($note->id);
    }

    Log::info("Note updated: $note->id and broadcasted.");
    // Broadcast the note update.
    broadcast(new NoteUpdated($note->id, $note->content))->toOthers();

    return redirect()->route('note.show.single', $note->id);
  }

}
