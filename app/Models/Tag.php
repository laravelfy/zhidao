<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * 标签
 *
 * @property integer $id
 * @property integer $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Tag extends BaseModel
{
    protected $fillable = ['name',];
}
