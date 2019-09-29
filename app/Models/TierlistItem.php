<?php

namespace App\Models;

use App\Events\TierlistItemCreated;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\TierlistItem
 *
 * @property int $id
 * @property int $tierlist_id
 * @property string|null $img
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|TierlistItem newModelQuery()
 * @method static Builder|TierlistItem newQuery()
 * @method static Builder|TierlistItem query()
 * @method static Builder|TierlistItem whereCreatedAt($value)
 * @method static Builder|TierlistItem whereId($value)
 * @method static Builder|TierlistItem whereImg($value)
 * @method static Builder|TierlistItem whereName($value)
 * @method static Builder|TierlistItem whereTierlistId($value)
 * @method static Builder|TierlistItem whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Tierlist $tierlist
 * @property-read TierlistItemStat $stat
 * @property-read string $real_img
 */
class TierlistItem extends Model
{
    /**
     * @return string
     */
    public function getImgAttribute(): string
    {
        return config('app.url') . '/storage/' . $this->attributes['img'];
    }

    /**
     * @return string
     */
    public function getRealImgAttribute(): string
    {
        return $this->attributes['img'];
    }

    //
    public function tierlist()
    {
        return $this->belongsTo(Tierlist::class);
    }

    public function stat()
    {
        return $this->hasOne(TierlistItemStat::class);
    }
}
