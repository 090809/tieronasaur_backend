<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Opinion
 *
 * @property int $id
 * @property int $tierlist_id
 * @property int $author_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Author $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OpinionItem[] $opinionItems
 * @property-read int|null $opinion_items_count
 * @property-read \App\Models\Tierlist $tierlist
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Opinion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Opinion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Opinion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Opinion whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Opinion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Opinion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Opinion whereTierlistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Opinion whereUpdatedAt($value)
 * @mixin \Eloquent
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
