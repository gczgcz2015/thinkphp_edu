<?php

namespace app\api\validate;

use think\Validate;

/**
 * 生成token校验
 */

 class Token extends Validate
 {
     protected $rule = [
        'appID' => 'require',
        'mobile' => 'mobile|require', 
        // 'nonce' => 'require',
        // 'timestamp' => 'number|require',
        // 'sign' => 'require'
     ];

     protected $message = [
         'appID.require' => 'appID不能为空',
         'mobile.mobile' => '手机号格式错误',
        //  'nonce.require' => '随机数不能为空',
        //  'timestamp.number' => '时间戳格式错误',
        //  'sign.require' => '签名不能为空',
     ];
 }