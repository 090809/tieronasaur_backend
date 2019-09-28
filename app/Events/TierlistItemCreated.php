<?php

namespace App\Events;

use App\Models\TierlistItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class TierlistItemCreated
 * @package App\Events
 * @property TierlistItem $item
 */
class TierlistItemCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $item;

    /**
     * Create a new event instance.
     *
     * @param TierlistItem $item
     */
    public function __construct(TierlistItem $item)
    {
        $this->item = $item;
    }
}
