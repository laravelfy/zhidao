<?php

namespace App\Models\Traits;

use App\Models\User;
use App\Models\Star;

/**
 * 可被点赞的能力
 */
trait withStar
{
    /**
     * 点赞者们
     *
     * @return MorphToMany
     */
    public function stargazers()
    {
        return $this->morphToMany(User::class, Star::getTableName());
    }
}
