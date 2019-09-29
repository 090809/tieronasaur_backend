<?php

namespace App\Http\Resources;

use App\Models\Opinion;
use Illuminate\Http\Resources\Json\JsonResource;

class OpinionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Opinion $opinion */
        $opinion = $this;
        return [
            'id' => $opinion->id ?? -1,
            'tierlist_id' => $opinion->tierlist_id,
            'author_id' => $opinion->author_id ?? -1,
            'opinions' => $opinion->opinionItems,
            'items' => $opinion->tierlist->items, // TODO: fix it at front-end
            'tags' => $opinion->tierlist->tags, // TODO: fix it at front-end
            'tierlist' => $opinion->tierlist, // TODO: fix it at front-end
        ];
    }
}
