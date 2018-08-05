<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Question;
use Illuminate\Database\Query\Builder;
use App\Models\User;
use App\Models\Taggable;
use App\Models\Follow;
use App\Models\Star;
use App\Models\Collect;

/**
 * 问题存储库
 */
class QuestionRepository extends BaseRepository
{
    /**
     * 创建问题
     *
     * @param string $title   标题
     * @param string $content 内容
     * @param User   $user    提问用户
     *
     * @return Question
     */
    public function store(string $title, string $content, User $user)
    {
        $question = new Question(['title' => $title, 'content' => $content]);
        $question->user()->associate($user);
        $question->save();

        return $question->fresh();
    }

    /**
     * 更新问题
     *
     * @param Question $question 问题
     * @param string   $content  问题内容
     * @param string   $title    问题标题
     * @param User     $user
     *
     * @return Question
     */
    public function update(Question $question, string $content, string $title = null, User $user)
    {
        $question->fill(['content' => $content]);
        if ($title) {
            $question->fill(['title' => $title]);
        }
        $question->save();

        return $question->fresh();
    }

    /**
     * 删除问题
     *
     * @param Question $question 问题
     * @param User     $user     用户
     *
     * @return bool|null
     */
    public function destory(Question $question, User $user)
    {
        return $question->delete();
    }

    /**
     * 加标签
     *
     * @param Question $question 问题
     * @param Tag      $tag      标签
     * @param User     $user     用户
     *
     * @return Taggable
     */
    public function tagAttach(Question $question, Tag $tag, User $user)
    {
        return $question->tagAttach($tag, $user);
    }

    /**
     * 取消标签
     *
     * @param Question $question 问题
     * @param Tag      $tag      标签
     * @param User     $user     用户
     *
     * @return bool|null
     */
    public function tagDetach(Question $question, Tag $tag, User $user)
    {
        return $question->tagDetach($tag, $user);
    }

    /**
     * 关注问题
     *
     * @param Question $question 问题
     * @param User     $user     用户
     *
     * @return Follow
     */
    public function follow(Question $question, User $user)
    {
        return $question->follow($user);
    }

    /**
     * 问题点赞
     *
     * @param Question $question 问题
     * @param User     $user     用户
     *
     * @return Star
     */
    public function star(Question $question, User $user)
    {
        return $question->star($user);
    }

    /**
     * 问题收藏
     *
     * @param Question $question 问题
     * @param User     $user     用户
     *
     * @return Collect
     */
    public function collect(Question $question, User $user)
    {
        return $question->collect($user);
    }

    /**
     * 列出问题
     *
     * @param array   $condition       条件
     * @param integer $page            页号
     * @param integer $page_size       页大小
     * @param string  $order_column    排序字段
     * @param string  $order_direction 排序方向
     *
     * @return Collection
     */
    public function listQuestion($condition = [], $page = 1, $page_size = 10, $order_column = 'created_at', $order_direction = 'DESC')
    {
        return Question::where($condition)->orderBy($order_column, $order_direction)->paginate($page_size = null, ['*'], 'page', $page);
    }

    /**
     * 根据标签筛选
     *
     * @param integer $tag_id          标签ID
     * @param integer $page            页号
     * @param integer $page_size       页大小
     * @param string  $order_column    排序字段
     * @param string  $order_direction 排序方向
     *
     * @return Collection
     */
    public function listQuestionByTag($tag_id, $page = 1, $page_size = 10, $order_column = 'created_at', $order_direction = 'DESC')
    {
        return Question::withHas('tagged', function (Builder $query) use ($tag_id) {
            $query->where(['tag_id', $tag_id]);
        })->paginate($page_size = null, ['*'], 'page', $page);
    }
}
