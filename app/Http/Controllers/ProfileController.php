<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\View\View;

/**
 * Controller for handling user profile operations.
 */
class ProfileController extends Controller {

  /**
   * Display the user's profile.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\View\View|RedirectResponse
   */
  public function show(Request $request): View|RedirectResponse {
    $user = $request->user();

    if ($user === NULL) {
      return redirect()->route('login')->with('error', 'You must be logged in to view your profile.');
    }

    return view('profile.show', ['user' => $user]);
  }

  /**
   * Update the user's profile.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request): RedirectResponse {
    $user = $request->user();

    if ($user === NULL) {
      return redirect()->route('login')->with('error', 'You must be logged in to update your profile.');
    }

    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
      'profile_picture' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('profile_picture')) {
      $profilePicture = $request->file('profile_picture');

      if ($profilePicture instanceof UploadedFile) {
        $path = $profilePicture->store('profile_pictures', 'public');
        if ($path !== FALSE) {
          $user->profile_picture = $path;
        }
      }
    }

    $user->fill($validated);

    if ($user->isDirty('email')) {
      $user->email_verified_at = NULL;
    }

    $user->save();

    return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
  }

  /**
   * Delete the user's profile.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Request $request): RedirectResponse {
    $user = $request->user();

    if ($user === NULL) {
      return redirect()->route('login')->with('error', 'You must be logged in to delete your profile.');
    }

    $user->delete();

    return redirect()->route('home')->with('success', 'Profile deleted successfully.');
  }

}
