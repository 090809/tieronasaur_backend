<?php

namespace App\Events;

use App\Models\TierlistKarma;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class TierlistKarmaCreated
 * @package App\Events
 * @property TierlistKarma $karma;
 */
class TierlistKarmaCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $karma;

    /**
     * Create a new event instance.
     *
     * @param TierlistKarma $karma
     */
    public function __construct(TierlistKarma $karma)
    {
        $this->karma = $karma;
    }
}
