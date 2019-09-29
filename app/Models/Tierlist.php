<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * App\Models\Tierlist
 *
 * @mixin Eloquent
 * @property int $votes
 * @property int $karma
 * @property int $id
 * @property string $name
 * @property int|null $author_id
 * @property int $rows_count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Author|null $author
 * @property-read Collection|TierlistKarma[] $karmas
 * @property-read int|null $karmas_count
 * @property-read mixed $popularity
 * @method static Builder|Tierlist newModelQuery()
 * @method static Builder|Tierlist newQuery()
 * @method static Builder|Tierlist query()
 * @method static Builder|Tierlist whereAuthorId($value)
 * @method static Builder|Tierlist whereCreatedAt($value)
 * @method static Builder|Tierlist whereId($value)
 * @method static Builder|Tierlist whereItemsCount($value)
 * @method static Builder|Tierlist whereName($value)
 * @method static Builder|Tierlist whereUpdatedAt($value)
 * @method static Builder|Tierlist whereViews($value)
 * @method static Builder|Tierlist friends($friends = array())
 * @method static Builder|Tierlist newly()
 * @method static Builder|Tierlist popular(Carbon $lastOpenedDate = null)
 * @method static Builder|Tierlist whereKarma($value)
 * @method static Builder|Tierlist whereVotes($value)
 * @property-read int|null $opinions_count
 * @property-read Collection|Opinion[] $opinions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read mixed $author_opinion
 * @property-read mixed $sum_opinion
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TierlistItemStat[] $itemStats
 * @property-read int|null $item_stats_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TierlistItem[] $items
 * @property int $karma_score
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tierlist whereKarmaScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tierlist whereRowsCount($value)
 * @property-read mixed $user_karma
 */
class Tierlist extends Model
{
    protected $with = ['items', 'author'];

    protected $fillable = ['rows_count', 'name'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function karmas()
    {
        return $this->hasMany(TierlistKarma::class);
    }

    public function items()
    {
        return $this->hasMany(TierlistItem::class);
    }

    public function itemStats()
    {
        return $this->hasManyThrough(TierlistItemStat::class, TierlistItem::class);
    }

    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @param Builder $query
     * @param Carbon|null $lastOpened
     * @return mixed
     */
    public function scopePopular(Builder $query, Carbon $lastOpened = null)
    {
        $lastOpened = $lastOpened ?? now()->subDay();
        $lastOpened = $lastOpened->greaterThan(now()->subDay()) ? now()->subDay() : $lastOpened;

        return $query
            ->where('created_at', '>=', $lastOpened)
            ->orderByDesc('votes');
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeNewly(Builder $query)
    {
        return $query->orderBy('created_at');
    }

    /**
     * @param Builder $query
     * @param string[] $friends
     * @return mixed
     */
    public function scopeFriends(Builder $query, array $friends = [])
    {
        return Tierlist::whereIn('author_id', $friends);
    }

    public function getOpinionsCountAttribute()
    {
        return $this->opinions()->count();
    }

    public function getAuthorOpinionAttribute()
    {
        return $this->opinions()->where('author_id', $this->author_id)->first();
    }

    public function getSumOpinionAttribute()
    {
        $opinion = new \stdClass();
        $opinionItems = [];

        /** @var TierlistItemStat $item_stat */
        foreach ($this->itemStats as $item_stat) {
            $opinionItems[] = ['vote' => $item_stat->vote_avg, 'tierlist_item_id' => $item_stat->tierlist_item_id];
        }

        $opinion->tierlist_id = $this->getQueueableId();
        $opinion->opinionItems = $opinionItems;
        return $opinion;
    }

    public function getUserKarmaAttribute()
    {
        /** @var TierlistKarma $karma */
        $karma = $this->karmas()->where('vk_user_id', \Auth::user()->id)->first();
        return $karma ? $karma->karma : 0;
    }
}
