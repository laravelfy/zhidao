<?php

namespace App\Models\Traits;

use App\Models\User;
use App\Models\Follow;

/**
 * 可被关注的能力
 */
trait withFollow
{
    /**
     * 关注者们
     *
     * @return MorphToMany
     */
    public function followers()
    {
        return $this->morphToMany(User::class, Follow::getTableName());
    }
}
