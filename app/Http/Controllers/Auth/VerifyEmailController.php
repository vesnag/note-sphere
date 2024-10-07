<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

/**
 * Controller for handling email verification.
 */
class VerifyEmailController extends Controller {

  /**
   * Mark the authenticated user's email address as verified.
   *
   * @param \Illuminate\Foundation\Auth\EmailVerificationRequest $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function __invoke(EmailVerificationRequest $request): RedirectResponse {
    $user = $request->user();

    if ($user === NULL) {
      return redirect()->route('login')->with('error', 'You must be logged in to verify your email.');
    }

    if ($user->hasVerifiedEmail()) {
      return redirect()->intended(route('dashboard') . '?verified=1');
    }

    if ($user instanceof MustVerifyEmail && $user->markEmailAsVerified()) {
      event(new Verified($user));
    }

    return redirect()->intended(route('dashboard') . '?verified=1');
  }

}
