<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Controller for handling password confirmation.
 */
class ConfirmablePasswordController extends Controller {
  /**
   * Session key for password confirmation timestamp.
   */
  private const PASSWORD_CONFIRMED_AT = 'auth.password_confirmed_at';

  /**
   * Show the confirm password view.
   *
   * @return \Illuminate\View\View
   */
  public function show(): View {
    return view('auth.confirm-password');
  }

  /**
   * Confirm the user's password.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   *
   * @throws \Illuminate\Validation\ValidationException.
   */
  public function store(Request $request): RedirectResponse {
    $user = $request->user();

    if (!$user || !$this->validatePassword($user->email, (string) $request->password)) {
      throw ValidationException::withMessages([
        'password' => __('auth.password'),
      ]);
    }

    $request->session()->put(self::PASSWORD_CONFIRMED_AT, time());

    return redirect()->intended(route('dashboard'));
  }

  /**
   * Validate the user's password.
   *
   * @param string $email
   * @param string $password
   *
   * @return bool
   */
  private function validatePassword(string $email, string $password): bool {
    return Auth::guard('web')->validate([
      'email' => $email,
      'password' => $password,
    ]);
  }

}
