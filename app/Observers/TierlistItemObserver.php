<?php

namespace App\Observers;

use App\Models\TierlistItem;

class TierlistItemObserver
{
    /**
     * Handle the tierlist item "created" event.
     *
     * @param TierlistItem $tierlistItem
     * @return void
     */
    public function created(TierlistItem $tierlistItem)
    {
        $tierlistItem->stat()->create([
            'vote_count' => 0,
            'vote_score' => 0
        ]);
    }
}
