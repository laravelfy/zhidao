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

    /**
     * 关注
     *
     * @param User $user 用户
     *
     * @return Follow
     */
    public function follow(User $user)
    {
        $follow = new Follow();
        $follow->followed()->associate($this);
        $follow->user()->associate($user);
        $follow->save();

        return $follow->fresh();
    }

    /**
     * 取消关注
     *
     * @param User $user
     *
     * @return bool
     */
    public function unfollow(User $user)
    {
        $follow = Follow::whereHas('followed', function ($query) use ($user) {
            $query->where('user_id', DB::raw('='), $user->id);
        })->whereHas('followed', function ($query) {
            $query->where([
                'followed_type' => get_class($type),
                'followed_id' => $this->id,
            ]);
        })->first();

        if (!$follow) {
            return;
        }
        return $follow->delete();
    }
}
