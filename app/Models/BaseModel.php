<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 基础模型
 */
class BaseModel extends Model
{
    /**
     * 静态返回表名
     *
     * @return string
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
