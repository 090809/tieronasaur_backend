<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\TierlistItemStat
 *
 * @property int $id
 * @property int $tierlist_item_id
 * @property int $vote_count
 * @property int $vote_score
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|TierlistItemStat newModelQuery()
 * @method static Builder|TierlistItemStat newQuery()
 * @method static Builder|TierlistItemStat query()
 * @method static Builder|TierlistItemStat whereCreatedAt($value)
 * @method static Builder|TierlistItemStat whereId($value)
 * @method static Builder|TierlistItemStat whereTierlistItemId($value)
 * @method static Builder|TierlistItemStat whereUpdatedAt($value)
 * @method static Builder|TierlistItemStat whereVoteCount($value)
 * @method static Builder|TierlistItemStat whereVoteScore($value)
 * @mixin Eloquent
 * @property-read mixed $vote_avg
 * @property-read \App\Models\TierlistItem $tierlistItem
 */
class TierlistItemStat extends Model
{
    public function tierlistItem()
    {
        return $this->belongsTo(TierlistItem::class);
    }

    public function getVoteAvgAttribute()
    {
        return $this->vote_score / $this->vote_count;
    }
}
