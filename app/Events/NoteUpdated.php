<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 *
 */
class NoteUpdated implements ShouldBroadcastNow {
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
    Log::info("Broadcasting NoteUpdated to channel: note-sphere-broadcasting.{$this->noteId}");

    return new PresenceChannel('note-sphere-broadcasting.' . $this->noteId);
  }

  /**
   * Data to broadcast.
   */
  public function broadcastWith() {
    return ['content' => $this->content];
  }

}
