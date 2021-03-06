<?php

namespace app\api\model;

use think\Model;

class Teacher extends Model
{
    protected $rule = [
        'name'  =>  'require|max:25',
        'mobile' =>  'require',
        'avatar' => 'require'
    ];
}