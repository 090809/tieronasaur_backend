<?php

namespace App\Listeners;

use App\Events\OpinionItemUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OpinionItemUpdateListener
{
    /**
     * Handle the event.
     *
     * @param  OpinionItemUpdated  $event
     * @return void
     */
    public function handle(OpinionItemUpdated $event)
    {
        $opinionItem = $event->item;
        $stat = $opinionItem->tierlistItem->stat;

        $stat->vote_score += $opinionItem->vote - $opinionItem->getOriginal('vote');
        $stat->save();
    }
}
