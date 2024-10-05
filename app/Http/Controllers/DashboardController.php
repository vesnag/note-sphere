<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller {

  public function index(): View {

    // TODO - Implement the error view.
    $user = auth()->user();
    if (!$user) {
      // Assuming there's an error view for unauthenticated users.
      return view('error');
    }

    $recentNotes = $user->notes()->latest()->take(5)->get();
    $userCount = User::count();

    return view('dashboard', compact('recentNotes', 'userCount'));
  }

}
