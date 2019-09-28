<?php

namespace App\Listeners;

use App\Events\TierlistKarmaUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TierlistKarmaUpdateListener
{
    /**
     * Handle the event.
     *
     * @param  TierlistKarmaUpdated  $event
     * @return void
     */
    public function handle(TierlistKarmaUpdated $event)
    {
        $karma = $event->karma;
        $tierlist = $karma->tierlist;
        $author = $tierlist->author;

        $tierlist->karma += $karma->karma * 2;
        $author->karma += $karma->karma * 2;
        /* При изменении кармы, мы должны учесть, что значение изменилось на 2 единицы. Было -1, стало +1 -> разница 2*/
        $tierlist->save();
        $author->save();
    }
}
