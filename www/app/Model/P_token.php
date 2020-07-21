<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class P_token extends Model
{
    public $table = 'p_token';              //声明model使用的表
    protected $primaryKey = 'id';     //声明表的主键
    public $timestamps=false;
}
