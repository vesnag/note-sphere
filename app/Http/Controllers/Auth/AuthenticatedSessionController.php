<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Controller for handling authenticated sessions.
 */
class AuthenticatedSessionController extends Controller {

  /**
   * Display the login view.
   *
   * @return \Illuminate\View\View
   */
  public function create(): View {
    return view('auth.login');
  }

  /**
   * Handle an incoming authentication request.
   *
   * @param \App\Http\Requests\Auth\LoginRequest $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(LoginRequest $request): RedirectResponse {
    $request->authenticate();

    $request->session()->regenerate();

    return redirect()->intended(route('dashboard'));
  }

  /**
   * Destroy an authenticated session.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Request $request): RedirectResponse {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }

}
