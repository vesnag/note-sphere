<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
 * Controller for handling password updates.
 */
class PasswordController extends Controller {

  /**
   * Update the user's password.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request): RedirectResponse {
    $validated = $request->validateWithBag('updatePassword', [
      'current_password' => ['required', 'current_password'],
      'password' => ['required', Password::defaults(), 'confirmed'],
    ]);

    $user = $request->user();

    if ($user === NULL) {
      return redirect()->route('login')->with('error', 'You must be logged in to update your password.');
    }

    $user->update([
      'password' => Hash::make($validated['password']),
    ]);

    return back()->with('status', 'password-updated');
  }

}
