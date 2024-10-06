<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller {

  /**
   * Display the dashboard.
   *
   * @return \Illuminate\View\View
   */
  public function index(): View {
    $user = auth()->user();

    $recentNotes = $user->notes()->latest()->take(5)->get();

    return view('dashboard', compact('recentNotes'));
  }

}
