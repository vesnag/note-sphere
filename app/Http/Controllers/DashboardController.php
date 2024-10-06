<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

/**
 * Controller for handling the dashboard.
 */
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
