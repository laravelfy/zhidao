<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 讨论
 *
 * @property integer                  $id
 * @property integer                  $user_id
 * @property string                   $commentable_type 墨菲类
 * @property string                   $commentable_id   墨菲ID
 * @property string                   $content          评论内容
 * @property User                     $user             评论者
 * @property Question|Ansewer|Comment $commentable      被关注的对象
 * @property Carbon                   $created_at
 * @property Carbon                   $updated_at
 * @property Carbon                   $deleted_at
 */
class Comment extends Model
{
    use Traits\withUser;
    use Traits\withStar;
    use Traits\withComment;

    /**
     * 被讨论的对象
     *
     * @return MorphToMany
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
