<?php

namespace app\api\model;

use think\Model;

class Teacher extends Model
{
    // protected $pk = 'uid';
    protected $rule = [
        'name'  =>  'require|max:25',
        'email' =>  'require',
        'avatar' => 'require'
    ];
}