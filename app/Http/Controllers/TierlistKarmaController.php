<?php

namespace App\Http\Controllers;

use App\Http\Requests\KarmaRequest;
use App\Models\Tierlist;
use App\Models\TierlistKarma;
use Auth;

class TierlistKarmaController extends Controller
{
    public function karma(Tierlist $tierlist, KarmaRequest $request)
    {
        if (!$tierlist)
            return response('', 403);

        /** @var TierlistKarma $karmaItem */
        $karmaItem = $tierlist->karmas()
            ->where(['vk_user_id' => Auth::user()->id])
            ->first();

        if (!$karmaItem) {
            $karmaItem = new TierlistKarma();
            $karmaItem->karma = $request->is_positive ? 1 : -1;
            $karmaItem->tierlist()->associate($tierlist);
            $karmaItem->vkUser()->associate(Auth::user());
            $karmaItem->save();

            return ["tierlist_karma" => $tierlist->karma_score];
        }

        $karmaValue = $request->is_positive ? 1 : -1;
        if ($karmaItem->karma !== $karmaValue) {
            $karmaItem->update(['karma' => $karmaValue]);
            $karmaItem->save();
        }

        return ["tierlist_karma" => $tierlist->karma_score];
    }
}
