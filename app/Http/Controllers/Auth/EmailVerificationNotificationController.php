<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Controller for handling email verification notifications.
 */
class EmailVerificationNotificationController extends Controller {

  /**
   * Send a new email verification notification.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request): RedirectResponse {
    $user = $request->user();

    if ($user === NULL) {
      return redirect()->route('login')->with('error', 'You must be logged in to verify your email.');
    }

    if ($user->hasVerifiedEmail()) {
      return redirect()->intended(route('dashboard'));
    }

    $user->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
  }

}
