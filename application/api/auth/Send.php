<?php

namespace app\api\auth;

trait Send
{

    /**
     *  返回成功信息
    */

    public static function returnMsg($code=200, $message='', $data=[], $header=[])
    {
        http_response_code($code);
        $res['code'] = (int)$code;
        $res['message'] = $message;
        $res['data'] = is_array($data) ? $data : ['info' => $data];

        foreach ($header as $key => $value) {
            if (is_null($value)) {
                header($key);
            } else {
                header($key . ':' . $value);
            }
        }
        exit(json_encode($res, JSON_UNESCAPED_UNICODE));
    }



}