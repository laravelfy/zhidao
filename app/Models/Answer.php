<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 答案
 *
 * @property integer    $id
 * @property integer    $question_id 问题ID
 * @property integer    $user_id     作者ID
 * @property string     $content     回答内容
 * @property User       $user        作者
 * @property Collection $followers   关注人们
 * @property Collection $stargazers  点赞者们
 * @property Collection $collectors  收藏者们
 * @property Carbon     $created_at
 * @property Carbon     $updated_at
 * @property Carbon     $deleted_at
 */
class Answer extends BaseModel
{
    use SoftDeletes;
    use Traits\withUser;
    use Traits\withCollect;
    use Traits\withFollow;
    use Traits\withStar;

    protected $fillable = [
        'content',
    ];
}
