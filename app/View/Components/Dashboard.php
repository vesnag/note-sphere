<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

/**
 * Dashboard component.
 */
class Dashboard extends Component {
  /**
   * The recent notes.
   *
   * @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note>
   */
  public Collection $recentNotes;

  /**
   * The title of the dashboard.
   *
   * @var string
   */
  public string $title;

  /**
   * Create a new component instance.
   *
   * @param \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $recentNotes
   * @param string $title
   */
  public function __construct(Collection $recentNotes, string $title) {
    $this->recentNotes = $recentNotes;
    $this->title = $title;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render() {
    return view('components.dashboard');
  }

}
