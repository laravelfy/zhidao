<?php

namespace App\Models\Traits;

use App\Models\Taggable;
use App\Models\Tag;

/**
 * 可被标签关联的能力
 */
trait withTaggable
{
    /**
     * 被标记的对象
     *
     * @return MorphToMany
     */
    public function tagged()
    {
        return $this->morphToMany(Tag::class, Taggable::getTableName());
    }

    /**
     * 加标签
     *
     * @param Tag      $tag      标签
     * @param User     $user     用户
     *
     * @return Taggable
     */
    public function tagAttach(Tag $tag, User $user)
    {
        $taggable = new Taggable();
        $taggable->tag()->associate($tag);
        $taggable->tagged()->associate($this);
        $taggable->save();

        return $taggable->fresh();
    }

    /**
     * 取消标签
     *
     * @param Tag $tag
     * @param User     $user     用户
     *
     * @return bool
     */
    public function tagDetach(Tag $tag, User $user)
    {
        $tag = Tag::whereHas('taggable', function ($query) use ($tag) {
            $query->where('tag_id', DB::raw('='), $tag->id);
        })->whereHas('taggable', function ($query) {
            $query->where([
                'taggable_type' => get_class($type),
                'taggable_id' => $this->id,
            ]);
        })->first();

        if (!$tag) {
            return;
        }
        return $tag->delete();
    }
}
