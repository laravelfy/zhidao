<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * 收藏记录
 *
 * @property integer $id
 * @property integer $user_id
 * @property string  $collect_type 莫菲类
 * @property string  $collect_id   莫菲ID
 * @property User    $user
 * @property Question|Ansewer $collected 被收藏的对象
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 */
class Collect extends BaseModel
{
    use Traits\withUser;

    /**
     * 被收藏的对象
     *
     * @return MorphTo
     */
    public function collected()
    {
        return $this->morphTo(strtolower(self::class));
    }
}
