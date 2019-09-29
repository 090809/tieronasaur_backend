<?php

namespace App\Observers;

use App\Models\TierlistKarma;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

class TierlistKarmaObserver
{
    /**
     * Handle the tierlist karma "created" event.
     *
     * @param TierlistKarma $karma
     * @return void
     */
    public function created(TierlistKarma $karma)
    {
        $tierlist = $karma->tierlist;
        $author = $tierlist->author;

        $tierlist->karma_score += $karma->karma;
        $tierlist->votes += 1;

        $author->karma += $karma->karma;
        $author->votes += 1;

        $tierlist->save();
        $author->save();

        return true;
    }

    /**
     * Handle the tierlist karma "updated" event.
     *
     * @param TierlistKarma $karma
     * @return void
     */
    public function updated(TierlistKarma $karma)
    {
        $tierlist = $karma->tierlist;
        $author = $tierlist->author;

        /* При изменении кармы, мы должны учесть, что значение изменилось на 2 единицы. Было -1, стало +1 -> разница 2*/
        $tierlist->karma_score += $karma->karma * 2;
        $author->karma += $karma->karma * 2;

        $tierlist->save();
        $author->save();

        return true;
    }
}
