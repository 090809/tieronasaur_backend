<?php

namespace App\Listeners;

use App\Events\OpinionItemCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OpinionItemCreateListener
{
    /**
     * Handle the event.
     *
     * @param  OpinionItemCreated  $event
     * @return void
     */
    public function handle(OpinionItemCreated $event)
    {
        $opinionItem = $event->item;
        $stat = $opinionItem->tierlistItem->stat;

        $stat->vote_count++;
        $stat->vote_score += $opinionItem->vote;
        $stat->save();
    }
}
