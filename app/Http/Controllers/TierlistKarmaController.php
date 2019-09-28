<?php

namespace App\Http\Controllers;

use App\Http\Requests\KarmaRequest;
use App\Models\Tierlist;
use App\Models\TierlistKarma;
use Illuminate\Http\Request;

class TierlistKarmaController extends Controller
{
    public function karma(Tierlist $tierlist, KarmaRequest $request)
    {
        /** @var TierlistKarma $karmaItem */
        $karmaItem = $tierlist->karmas()->first(['vk_user_id' => \Auth::user()->id]);

        if (!$karmaItem->exists()) {
            $karmaItem = new TierlistKarma();
            $karmaItem->karma = $request->is_positive ? 1 : -1;
            $karmaItem->tierlist()->associate($tierlist);
            $karmaItem->vkUser()->associate(\Auth::user());
            return;
        }

        $karmaValue = $request->is_positive ? 1 : -1;
        if ($karmaItem->karma !== $karmaValue) {
            $karmaItem->karma = $karmaItem;
            $karmaItem->save();
        }
    }
}
