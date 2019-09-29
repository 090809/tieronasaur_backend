<?php

namespace App\Observers;

use App\Models\OpinionItem;
use App\Models\TierlistItemStat;

class OpinionItemObserver
{
    /**
     * Handle the opinion item "created" event.
     *
     * @param OpinionItem $opinionItem
     * @return void
     */
    public function created(OpinionItem $opinionItem)
    {
        /** @var TierlistItemStat $stat */
        $stat = TierlistItemStat::where('tierlist_item_id', $opinionItem->tierlist_item_id)->first();
        //dd($stat);
        //$stat = $opinionItem->tierlistItem->stat;

        $stat->vote_count++;
        $stat->vote_score += $opinionItem->vote;
        $stat->save();
    }

    /**
     * Handle the opinion item "updated" event.
     *
     * @param OpinionItem $opinionItem
     * @return void
     */
    public function updated(OpinionItem $opinionItem)
    {
        $stat = $opinionItem->tierlistItem->stat;

        $stat->vote_score += $opinionItem->vote - $opinionItem->getOriginal('vote');
        $stat->save();
    }
}
