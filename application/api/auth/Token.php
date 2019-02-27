<?php

namespace app\api\auth;
use app\api\auth\Send;
use think\Request;
use think\Cache;
// use app\api\validate\Token;
use app\api\auth\Oauth;

/**
 * 生成token
 */
class Token
{
    use Send;

    /**
     * 请求时间差
     */

    public static $timeDif = 10000;
    public static $TokenPrefix = 'Token_';
    public static $refreshTokenPrefix = 'refreshToken_';
    public static $expires = 7200;
    public static $refreshExpires = 60*60*24*30;

    public static $appID = 'test';
    public static $appSecret = '123456';


    /**
     * 生成token
     */

    public static function checkParams($params = [])
    {

        // 时间戳校验
        if(abs($params['timestamp']-time()) > self::$timeDif) {
            return self::returnMsg(401, '客户端时间不同步', 'timestamp:'.time());
        }
        // appid检测
        if($params['appID'] !== self::$appID) {
            return self::returnMsg(401, 'appID错误');
        }
        
        // 签名检测
        // $sign = Oauth::makeSign($params, self::$appSecret);
        // if($sign !== $params['sign'])
        // {
        //     return self::returnMsg(401, 'sign错误', 'sign:' . $sign);
        // }
    }

    public function getToken($user)
    {
        try {
            $token = self::setToken($user);
            return $token;
        } catch (Exception $e) {
            return '';
        }
    }

    // public function token(Request $request)
    // {
    //     $validate = new \app\api\validate\Token;
    //     if (!$validate->check(input(''))) {
    //         return self::returnMsg(401, $validate->getError());
    //     }
    //     self::checkParams(input(''));

    //     $userInfo = [];
    //     try {
    //         $token = self::setToken();
    //         return self::returnMsg(200, 'success', $token);
    //     } catch (Exception $e) {
    //         return self::returnMsg(500, 'fail', $e);
    //     }
    // }

    /**
     * 设置Token
     */

    protected function setToken($clientInfo)
    {
        // 生成token
        $token = self::buildToken();
        $tokenInfo = [
            'token' => $token,
            'expires_time' => time() + self::$expires,
            'client' => $clientInfo,
        ];
        self::saveToken($token, $tokenInfo);
        return $tokenInfo;
    }

    /**
     * 生成随机字符串
     */
    protected static function buildToken($length=32)
    {
        $str_pol = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstuvwxyz";
		return substr(str_shuffle($str_pol), 0, $length);
    }

    /**
     * 存储token
     */
    protected static function saveToken($token, $tokenInfo)
    {
        cache(self::$TokenPrefix . $token, $tokenInfo, self::$expires);
    }
}
