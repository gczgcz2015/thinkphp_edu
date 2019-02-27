<?php
namespace app\api\controller;
use think\Request;
use think\Cache;
use app\api\auth\Send;
use think\Controller;
use think\Validate;
use app\api\model\Teacher;
use app\api\auth\Token;

// use think\vau

class LoginController extends Controller {

    /**
     * 模拟短信接口
     */

    use Send;

    public function code(Request $request) {
        // 验证手机号
        $validate = new Validate([
            'mobile'  => 'require|length:11',
        ]);
        if(!$validate->check(input('')))
        {
            return self::returnMsg(200, '手机号格式错误');
        }
        Cache::set('code_' . input('mobile'), '1234', 3600);
        return Cache::get('code_' . input('mobile'));
    }

    /**
     * 注册
     */
    public function register(Request $request)
    {
        $validate = new Validate([
            'mobile'  => 'require|length:11',
            'avatar' => 'require',
            'name' => 'require'
        ]);

        if(!$validate->check(input('')))
        {
            return self::returnMsg(200, $validate->getError());
        }

        $user = new Teacher;
        $user->name = input('name');
        $user->avatar = input('avatar');
        $user->mobile = input('mobile');
        $user->save();
        return $user;
    }

    /**
     * 登陆
     */
    public function login(Request $request)
    {
        // 省略验证码注册环节...
        $code = Cache::get('code_' . input('mobile'));
        if($code !== '1234')
        {
            return self::returnMsg(200, '验证码错误');
        }
        
        // 查询用户信息
        $user = Teacher::get(['mobile' => input('mobile')]);
        if (!$user)
        {
            return self::returnMsg(200, '无此用户');
        }
        // 返回token
        $token = new Token;
        $user['appID'] = input('appID');
        $token = $token->getToken($user);
        $data = ['token' => $token, 'user' => $user];
        return $data;
    }
}