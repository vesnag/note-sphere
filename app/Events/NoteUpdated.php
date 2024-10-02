<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

/**
 *
 */
class NoteUpdated implements ShouldBroadcast {
  use InteractsWithSockets, SerializesModels;

  public $noteId;
  public $content;

  public function __construct($noteId, $content) {
    $this->noteId = $noteId;
    $this->content = $content;
  }

  /**
   * Define the channel this event will be broadcasted on.
   */
  public function broadcastOn() {
    // TODO change this to a private channel.
    return new Channel('note.' . $this->noteId);
  }

  /**
   * Data to broadcast.
   */
  public function broadcastWith() {
    return ['content' => $this->content];
  }

}
