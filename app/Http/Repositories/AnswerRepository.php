<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\User;
use App\Models\Star;
use App\Models\Collect;

/**
 * 答案的存储库
 */
class AnswerRepository extends BaseRepository
{
    /**
     * 创建答案
     *
     * @param Question $question 问题
     * @param string   $content  回答内容
     * @param User     $author   回答人
     *
     * @return Answer
     */
    public function store(Question $quesiton, string $content, User $user)
    {
        $answer = new Answer(['content' => $content]);
        $answer->question()->associate($quesiton);
        $answer->user()->associate($user);
        $answer->save();

        return $answer->fresh();
    }

    /**
     * 修改答案
     *
     * @param Answer $answer  答案
     * @param string $content 内容
     * @param User   $user    修改者
     *
     * @return Answer
     */
    public function update(Answer $answer, string $content, User $user)
    {
        $answer->fill(['content' => $content]);
        $answer->save();
        //if ($user) {
        //    $answer->user()->associate($user);
        //}
        return $answer->fresh();
    }

    /**
     * 删除答案
     *
     * @param Answer $answer 答案
     *
     * @return bool|null
     */
    public function destroy(Answer $answer, User $user)
    {
        return $answer->delete();
    }

    /**
     * 答案点赞
     *
     * @param Answer $answer 答案
     * @param User   $user   用户
     *
     * @return Star
     */
    public function star(Answer $answer, User $user)
    {
        return $answer->star($user);
    }

    /**
     * 答案收藏
     *
     * @param Answer $answer 答案
     * @param User   $user   用户
     *
     * @return Collect
     */
    public function collect(Answer $answer, User $user)
    {
        return $answer->collect($user);
    }
}
