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
     * 点赞者们
     *
     * @return MorphToMany
     */
    public function stargazers()
    {
        return $this->morphToMany(Tag::class, Taggable::getTableName());
    }
}
