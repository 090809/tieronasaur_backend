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

            $tierlist = $karmaItem->tierlist;
            $author = $tierlist->author;

            $tierlist->karma_score += $karmaItem->karma;
            $tierlist->votes += 1;

            $author->karma += $karmaItem->karma;
            $author->votes += 1;

            $tierlist->save();
            $author->save();

            return ["tierlist_karma" => $tierlist->karma_score];
        }

        $karmaValue = $request->is_positive ? 1 : -1;
        if ($karmaItem->karma !== $karmaValue) {
            $karmaItem->update(['karma' => $karmaValue]);

            $tierlist = $karmaItem->tierlist;
            $author = $tierlist->author;

            /* При изменении кармы, мы должны учесть, что значение изменилось на 2 единицы. Было -1, стало +1 -> разница 2*/
            $tierlist->karma_score += $karmaItem->karma * 2;
            $author->karma += $karmaItem->karma * 2;

            $tierlist->save();
            $author->save();
        }

        return ["tierlist_karma" => $tierlist->karma_score];
    }
}
