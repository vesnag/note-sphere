<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

/**
 * Controller for managing user profiles.
 */
class ProfileController extends Controller {

  /**
   * Update the user's profile picture.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function updatePicture(Request $request): RedirectResponse {
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
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\View\View
   */
  public function edit(Request $request): View {
    return view('profile.edit', [
      'user' => $request->user(),
    ]);
  }

  /**
   * Update the user's profile information.
   *
   * @param \App\Http\Requests\ProfileUpdateRequest $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(ProfileUpdateRequest $request): RedirectResponse {
    $user = $request->user();
    $user->fill($request->validated());

    if ($user->isDirty('email')) {
      $user->email_verified_at = NULL;
    }

    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
  }

  /**
   * Delete the user's account.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
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
