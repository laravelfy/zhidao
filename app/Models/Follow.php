<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 关注记录
 *
 * @property integer $id
 * @property integer $user_id
 * @property string  $follow_type 莫菲类
 * @property string  $follow_id   莫菲ID
 * @property User    $user
 * @property Question|Ansewer|User $followed 被关注的对象
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 */
class Follow extends BaseModel
{
    use Traits\withUser;

    /**
     * 被收藏的对象
     *
     * @return void
     */
    public function followed()
    {
        return $this->morphTo(strtolower(self::class));
    }
}
