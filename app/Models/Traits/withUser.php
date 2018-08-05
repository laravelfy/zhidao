<?php

namespace App\Models\Traits;

use App\Models\User;

/**
 * 有被用户创造的能力
 */
trait withUser
{
    protected $with = ['user', ];

    /**
     * 用户
     *
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
