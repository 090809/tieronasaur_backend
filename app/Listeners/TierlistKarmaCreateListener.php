<?php

namespace App\Listeners;

use App\Events\TierlistKarmaCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TierlistKarmaCreateListener
{
    /**
     * Handle the event.
     *
     * @param  TierlistKarmaCreated  $event
     * @return void
     */
    public function handle(TierlistKarmaCreated $event)
    {
        $karma = $event->karma;
        $tierlist = $karma->tierlist;
        $author = $tierlist->author;

        $tierlist->karma += $karma->karma;
        $tierlist->votes++;
        $author->karma += $karma->karma;
        $author->votes++;

        $tierlist->save();
        $author->save();
    }
}
