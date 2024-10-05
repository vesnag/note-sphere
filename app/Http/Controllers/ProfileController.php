<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

/**
 *
 */
class ProfileController extends Controller {

  /**
   * Update the user's profile picture.
   */
  public function updatePicture(Request $request) {
    $request->validate([
      'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = $request->user();

    if ($request->hasFile('profile_picture')) {
      $file = $request->file('profile_picture');
      $path = $file->store('profile_pictures', 'public');
      $user->profile_picture = $path;
      $user->save();
    }

    return Redirect::route('profile.edit')->with('status', 'profile-picture-updated');
  }

  /**
   * Display the user's profile form.
   */
  public function edit(Request $request): View {
    return view('profile.edit', [
      'user' => $request->user(),
    ]);
  }

  /**
   * Update the user's profile information.
   */
  public function update(ProfileUpdateRequest $request): RedirectResponse {
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
      $request->user()->email_verified_at = NULL;
    }

    $request->user()->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
  }

  /**
   * Delete the user's account.
   */
  public function destroy(Request $request): RedirectResponse {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }

}
