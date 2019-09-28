<?php

namespace App\Events;

use App\Models\OpinionItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class OpinionItemCreated
 * @package App\Events
 * @property OpinionItem $item
 */
class OpinionItemCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $item;

    /**
     * Create a new event instance.
     *
     * @param OpinionItem $item
     */
    public function __construct(OpinionItem $item)
    {
        $this->item = $item;
    }
}
