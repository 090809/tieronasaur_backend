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
    public function creating(TierlistKarma $karma)
    {

    }

    /**
     * Handle the tierlist karma "updated" event.
     *
     * @param TierlistKarma $karma
     * @return void
     */
    public function updating(TierlistKarma $karma)
    {

    }
}
