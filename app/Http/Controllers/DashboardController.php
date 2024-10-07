<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 *
 */
class DashboardController extends Controller {

  /**
   * Display the dashboard.
   *
   * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
   */
  public function index(): View | RedirectResponse {
    $user = auth()->user();

    if (NULL === $user) {
      return redirect()->route('login');
    }

    $recentNotes = $user->notes()->latest()->take(5)->get();

    return view('dashboard', compact('recentNotes'));
  }

}
