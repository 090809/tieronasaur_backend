<?php

namespace App\Listeners;

use App\Events\TierlistItemCreated;
use App\Models\TierlistItem;
use App\Models\TierlistItemStat;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TierlistItemCreateListener
{
    /**
     * Handle the event.
     *
     * @param  TierlistItemCreated  $event
     * @return void
     */
    public function handle(TierlistItemCreated $event)
    {
        /** @var TierlistItem $item */
        $item = $event->item;

        $item->stat()->create([
            'vote_count' => 0,
            'vote_score' => 0
        ]);
    }
}
