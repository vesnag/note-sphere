<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Dashboard extends Component {
  public $recentNotes;
  public $title;

  public function __construct($recentNotes, $title) {
    $this->recentNotes = $recentNotes;
    $this->title = $title;
  }

  public function render() {
    return view('components.dashboard');
  }

}
