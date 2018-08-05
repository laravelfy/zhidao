<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * 标签
 *
 * @property integer $id
 * @property integer $name
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 */
class Tag extends BaseModel
{
    protected $fillable = ['name',];

    /**
     * 获取此标签下问题
     *
     * @return MorphToMany
     */
    public function questions()
    {
        $this->morphedByMany(Question::class, Taggable::getTableName());
    }

    /**
     * 获取此标签下的所有用户
     *
     * @return void MorphToMany
     */
    public function users()
    {
        $this->morphedByMany(User::class, Taggable::getTableName());
    }
}
