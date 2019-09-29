<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Author
 *
 * @property int $id
 * @property int|null $vk_id
 * @property int $is_community
 * @property int $karma
 * @property int $votes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Tierlist[] $tierlists
 * @property-read int|null $tierlists_count
 * @property-read VkUser $vkUser
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author newQuery()
 * @method static Builder|Author onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Author query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereIsCommunity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereKarma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereVkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereVotes($value)
 * @method static Builder|Author withTrashed()
 * @method static Builder|Author withoutTrashed()
 * @mixin Eloquent
 * @property int|null $vk_user_id
 * @property int|null $vk_community_id
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereVkCommunityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereVkUserId($value)
 */
class Author extends Model
{
    use SoftDeletes;

    public function tierlists()
    {
        return $this->hasMany(Tierlist::class);
    }

    public function getTierlistsCountAttribute()
    {
        return $this->tierlists()->count();
    }

    public function vkUser()
    {
        return $this->belongsTo(VkUser::class);
    }
}
