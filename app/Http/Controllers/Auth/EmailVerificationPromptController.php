<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller for displaying the email verification prompt.
 */
class EmailVerificationPromptController extends Controller {

  /**
   * Display the email verification prompt.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse|View
   */
  public function __invoke(Request $request): RedirectResponse|View {
    $user = $request->user();

    if ($user === NULL) {
      return redirect()->route('login')->with('error', 'You must be logged in to verify your email.');
    }

    return $user->hasVerifiedEmail()
            ? redirect()->intended(route('dashboard'))
            : view('auth.verify-email');
  }

}
