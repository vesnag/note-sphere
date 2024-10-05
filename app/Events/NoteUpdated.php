<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
class NoteUpdated implements ShouldBroadcastNow {
  use InteractsWithSockets, SerializesModels;

  public function __construct(
    public int $noteId,
    public string $content,
  ) {}

  public function broadcastOn(): PresenceChannel {
    Log::info("Broadcasting NoteUpdated to channel: note-sphere-broadcasting.{$this->noteId}");
    return new PresenceChannel('note-sphere-broadcasting.' . $this->noteId);
  }

  public function broadcastWith(): array {
    return ['content' => $this->content];
  }

}
