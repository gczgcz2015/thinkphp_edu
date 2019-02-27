<?php

namespace app\api\model;

use think\Model;

class Organization extends Model
{
    protected $rule = [
        'name'  =>  'require|max:25',
        'logo' => 'require',
        'idcard' => 'require'
    ];
}