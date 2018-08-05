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

    /**
     * 点赞
     *
     * @param User $user 用户
     *
     * @return Star
     */
    public function star(User $user)
    {
        $star = new Star();
        $star->stared()->associate($this);
        $star->user()->associate($user);
        $star->save();

        return $star->fresh();
    }

    /**
     * 取消点赞
     *
     * @param User $user
     *
     * @return bool
     */
    public function unstar(User $user)
    {
        $star = Star::whereHas('stared', function ($query) use ($user) {
            $query->where('user_id', DB::raw('='), $user->id);
        })->whereHas('stared', function ($query) {
            $query->where([
                'stared_type' => get_class($type),
                'stared_id' => $this->id,
            ]);
        })->first();

        if (!$star) {
            return;
        }
        return $star->delete();
    }
}
