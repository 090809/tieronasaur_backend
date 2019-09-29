<?php

namespace App\Http\Resources;

use App\Models\Tierlist;
use Illuminate\Http\Resources\Json\JsonResource;

class TierlistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Tierlist $tierlist */
        $tierlist = $this;
        return [
            'id' => $tierlist->getQueueableId(),
            'name' => $tierlist->name,
            'author' => $tierlist->author,
            'votes' => $tierlist->votes,
            'karma' => $tierlist->karma_score,
            'items' => $tierlist->items,
            'tags' => $tierlist->tags,
            'user_karma' => $tierlist->user_karma,
            'author_opinion' => OpinionResource::make($tierlist->author_opinion),
            'rows_count' => $tierlist->rows_count,
            'created_at' => $tierlist->created_at,
        ];
    }
}
