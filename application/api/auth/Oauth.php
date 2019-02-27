<?php
namespace app\api\auth;

use app\api\auth\Send;
use think\Exception;
use think\Request;
use think\Cache;

class Oauth
{

    use Send;

    public static $tokenPrefix = 'Token_';
    public static $expires = 7200;

    final function authenticate()
    {
        return self::certification(self::getClient());
    }

    /**
     * 获取用户信息
     */
    public static function getClient()
    {
        try {
            $auth = Request::instance()->header()['authentication'];
            $auth = explode(' ', $auth);
            $auth =  explode(':', base64_decode($auth[1]));
            $client['appID'] = $auth[0];
            $client['token'] = $auth[1];
            $client['uid'] = $auth[2];
            return $client;
        } catch (Exception $e) {
            return self::returnMsg(401,'Invalid authorization credentials');
        }
    }

    /**
     * 验证权限
     */
    public static function certification($data = [])
    {
        $cachedToken = Cache::get(self::$tokenPrefix . $data['token']);
        if(!$cachedToken)
        {
            return self::returnMsg(401, 'fail', 'token错误');
        }
        if($cachedToken['client']['appID'] !== $data['appID'])
        {
            return self::returnMsg(401, 'fail', $cachedToken['client']['appID']);
        }
        return $data;
    }

    /**
     *  生成签名
    */   

    public static function makeSign ($data=[], $app_secret='')
    {
        unset($data['version']);
        unset($data['sign']);
        return self::_getOrderMd5($data, $app_secret);
    }

    private static function _getOrderMd5($params=[], $app_secret='')
    {
        ksort($params);
        $params['key'] = $app_secret;
        return strtolower(md5(urldecode(http_build_query($params))));
    }
}