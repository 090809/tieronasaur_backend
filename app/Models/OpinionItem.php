<?php

namespace App\Models;

use App\Events\OpinionItemCreated;
use App\Events\OpinionItemUpdated;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\OpinionItem
 *
 * @property int $id
 * @property int $opinion_id
 * @property int $tierlist_item_id
 * @property int $vote
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|OpinionItem newModelQuery()
 * @method static Builder|OpinionItem newQuery()
 * @method static Builder|OpinionItem query()
 * @method static Builder|OpinionItem whereCreatedAt($value)
 * @method static Builder|OpinionItem whereId($value)
 * @method static Builder|OpinionItem whereOpinionId($value)
 * @method static Builder|OpinionItem whereTierlistItemId($value)
 * @method static Builder|OpinionItem whereUpdatedAt($value)
 * @method static Builder|OpinionItem whereVote($value)
 * @mixin Eloquent
 * @property-read \App\Models\Opinion $opinion
 * @property-read \App\Models\TierlistItem $tierlistItem
 */
class OpinionItem extends Model
{
    public function opinion()
    {
        return $this->belongsTo(Opinion::class);
    }

    public function tierlistItem()
    {
        return $this->belongsTo(TierlistItem::class);
    }

    protected $dispatchesEvents = [
        'created' => OpinionItemCreated::class,
        'updated' => OpinionItemUpdated::class,
    ];
}
