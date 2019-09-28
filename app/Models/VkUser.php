<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\VkUser
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|VkUser newModelQuery()
 * @method static Builder|VkUser newQuery()
 * @method static Builder|VkUser query()
 * @method static Builder|VkUser whereCreatedAt($value)
 * @method static Builder|VkUser whereId($value)
 * @method static Builder|VkUser whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Author $author
 */
class VkUser extends Authenticatable implements JWTSubject
{
    protected $primaryKey = 'id';

    protected $fillable = ['id'];

    public function author()
    {
        return $this->hasOne(Author::class, 'vk_user_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
