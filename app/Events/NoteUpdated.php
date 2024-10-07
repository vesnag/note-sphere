<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

/**
 *
 */
class NoteUpdated implements ShouldBroadcastNow {
  use InteractsWithSockets, SerializesModels;

  /**
   * Create a new event instance.
   *
   * @param int $noteId
   * @param string $content
   */
  public function __construct(
    public int $noteId,
    public string $content,
  ) {}

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\PresenceChannel
   */
  public function broadcastOn(): PresenceChannel {
    return new PresenceChannel('note-sphere-broadcasting.' . $this->noteId);
  }

  /**
   * Get the data to broadcast.
   *
   * @return array<string, string>
   */
  public function broadcastWith(): array {
    return ['content' => $this->content];
  }

}
