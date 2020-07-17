<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public $table = 'p_users';              //声明model使用的表
    protected $primaryKey = 'user_id';     //声明表的主键
    public $timestamps=false;
}
