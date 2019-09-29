<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Opinion
 *
 * @property int $id
 * @property int $tierlist_id
 * @property int $author_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Author $author
 * @property-read Collection|OpinionItem[] $opinionItems
 * @property-read int|null $opinion_items_count
 * @property-read Tierlist $tierlist
 * @method static Builder|Opinion newModelQuery()
 * @method static Builder|Opinion newQuery()
 * @method static Builder|Opinion query()
 * @method static Builder|Opinion whereAuthorId($value)
 * @method static Builder|Opinion whereCreatedAt($value)
 * @method static Builder|Opinion whereId($value)
 * @method static Builder|Opinion whereTierlistId($value)
 * @method static Builder|Opinion whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Opinion extends Model
{

    public function tierlist()
    {
        return $this->belongsTo(Tierlist::class);
    }

    public function opinionItems()
    {
        return $this->hasMany(OpinionItem::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
