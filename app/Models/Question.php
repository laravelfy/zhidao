<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * 问题
 *
 * @property integer    $id         问题ID
 * @property integer    $user_id    提问人id
 * @property string     $title      问题标题
 * @property string     $content    问题内容
 * @property User       $user       提问人
 * @property Collection $answers    答案们
 * @property Collection $followers  关注人们
 * @property Collection $stargazers 点赞者们
 * @property Collection $collectors 收藏者们
 * @property Carbon     $created_at
 * @property Carbon     $updated_at
 * @property Carbon     $deleted_at
 */
class Question extends BaseModel
{
    use SoftDeletes;
    use Traits\withUser;
    use Traits\withCollect;
    use Traits\withFollow;
    use Traits\withStar;
    use Traits\withTaggable;

    protected $fillable = [
        'title',
        'content',
    ];

    protected $with = [
        'user',
        'answers',
    ];

    /**
     * 问题下的答案列表
     *
     * @return HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
