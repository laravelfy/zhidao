<?php

namespace App\Models\Traits;

use App\Models\User;
use App\Models\Collect;

/**
 * 可被收藏的能力
 */
trait withColelct
{
    /**
     * 收藏者们
     *
     * @return MorphToMany
     */
    public function collectors()
    {
        return $this->morphToMany(User::class, Collect::getTableName());
    }
}
