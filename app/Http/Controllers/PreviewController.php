<?php

namespace App\Http\Controllers;

use App\Http\Resources\OpinionResource;
use App\Models\OpinionItem;
use App\Models\Tierlist;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function show(Tierlist $tierlist)
    {
        return $this->generate(OpinionResource::make($tierlist->sum_opinion)->toArray(\request()), $tierlist);
    }

    public function showMe(Tierlist $tierlist)
    {
        return $this->generate(OpinionResource::make(
            $tierlist->opinions()->firstOrCreate(['author_id' => \Auth::user()->author->getQueueableId()])
        )->toArray(\request()), $tierlist);
    }

    public function showAuthor(Tierlist $tierlist)
    {
        return $this->generate(OpinionResource::make($tierlist->author_opinion)->toArray(\request()), $tierlist);
    }

    protected function generate(array $resource, Tierlist $tierlist)
    {
        $itemWeight = 75;
        $itemHeight = 67;

        $weight = $itemWeight * $tierlist->items_count;
        $height = $itemHeight * $tierlist->items_count;

        $votes = [];
        for ($i = 0; $i < $tierlist->items_count; $i++) {
            $votes[$i] = ["count" => 0, "tierlist_item_id" => []];
        }
        //dd($resource);
        /** @var OpinionItem $opinion */
        foreach ($resource['opinions'] as $opinion) {
            if (count($votes[$i]) < 5)
                $votes[$opinion->vote]["tierlist_item_ids"][] = $opinion->tierlist_item_id;
            $votes[$opinion->vote]["count"]++;
        }

        dd($votes);
    }
}
