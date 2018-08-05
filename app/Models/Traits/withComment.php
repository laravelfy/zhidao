<?php

namespace App\Models\Traits;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * 可被评论的能力
 */
trait withComment
{
    /**
     * 当前对象的评论列表(嵌套)
     *
     * @return Collection
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * 发表讨论
     *
     * @param string $content 内容
     * @param User   $user    评论人
     *
     * @return Comment
     */
    public function comment(string $content, User $user)
    {
        $comment = new Comment(['content' => $content]);
        $comment->user()->associate($user);
        $comment->save();

        return $comment->fresh();
    }
}
