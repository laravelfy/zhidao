<?php

namespace App\Models\Traits;

use App\Models\User;
use App\Models\Collect;
use Illuminate\Database\Query\Builder;
use DB;

/**
 * 可被收藏的能力
 */
trait withCollect
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

    /**
     * 收藏
     *
     * @param User $user 用户
     *
     * @return Collect
     */
    public function collect(User $user)
    {
        $collect = new Collect();
        $collect->collected()->associate($this);
        $collect->user()->associate($user);
        $collect->save();

        return $collect->fresh();
    }

    /**
     * 取消收藏
     *
     * @param User $user
     *
     * @return bool
     */
    public function uncollect(User $user)
    {
        $collect = Collect::whereHas('collected', function ($query) use ($user) {
            $query->where('user_id', DB::raw('='), $user->id);
        })->whereHas('collected', function ($query) {
            $query->where([
                'collected_type' => get_class($type),
                'collected_id' => $this->id,
            ]);
        })->first();

        if (!$collect) {
            return;
        }
        return $collect->delete();
    }
}
