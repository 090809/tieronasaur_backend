<?php

namespace App\Models;

use App\Events\TierlistKarmaCreated;
use App\Events\TierlistKarmaUpdated;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\TierlistKarma
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $vk_id
 * @property int $tierlist_id
 * @property int $karma
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Tierlist $tierlist
 * @method static Builder|TierlistKarma newModelQuery()
 * @method static Builder|TierlistKarma newQuery()
 * @method static Builder|TierlistKarma query()
 * @method static Builder|TierlistKarma whereCreatedAt($value)
 * @method static Builder|TierlistKarma whereId($value)
 * @method static Builder|TierlistKarma whereKarma($value)
 * @method static Builder|TierlistKarma whereTierlistId($value)
 * @method static Builder|TierlistKarma whereUpdatedAt($value)
 * @method static Builder|TierlistKarma whereVkId($value)
 */
class TierlistKarma extends Model
{

    public function tierlist()
    {
        return $this->belongsTo(Tierlist::class);
    }

    protected $dispatchesEvents = [
        'created' => TierlistKarmaCreated::class,
        'updated' => TierlistKarmaUpdated::class
    ];
}
