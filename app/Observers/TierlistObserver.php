<?php

namespace App\Observers;

use App\Models\Opinion;
use App\Models\Tierlist;

class TierlistObserver
{
    /**
     * Handle the tierlist "created" event.
     *
     * @param Tierlist $tierlist
     * @return void
     */
    public function created(Tierlist $tierlist)
    {
        $author = $tierlist->author;
        $opinion = new Opinion();
        $opinion->author()->associate($author);
        $opinion->tierlist()->associate($tierlist);
        $opinion->save();
    }
}
