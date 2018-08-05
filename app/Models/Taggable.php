<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 打标签
 *
 * @property integer $id
 * @property integer $tag_id        标签ID
 * @property string  $taggable_type 莫菲类
 * @property string  $taggable_id   莫菲ID
 * @property Tag     $tag           标签
 * @property Question|Ansewer|User $tagged 被打标签的对象
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 */
class Taggable extends BaseModel
{
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    /**
     * 被打标签的对象
     *
     * @return void
     */
    public function tagged()
    {
        return $this->morphTo(strtolower(self::class));
    }
}
