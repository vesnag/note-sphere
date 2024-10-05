<?php

namespace App\Http\Controllers;

use App\Models\User;

/**
 *
 */
class DashboardController extends Controller {

  /**
   *
   */
  public function index() {
    $user = auth()->user();
    $recentNotes = $user->notes()->latest()->take(5)->get();
    $userCount = User::count();

    return view('dashboard', compact('recentNotes', 'userCount'));
  }

}
