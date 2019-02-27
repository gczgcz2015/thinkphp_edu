<?php

namespace app\api\controller;

use app\api\auth\Send;
use think\Request;
use app\api\auth\Oauth;



class ApiController
{

    /**
     * api基类
     */

    use Send;

    protected $request;
    protected $clientInfo;

    // protected $noAuth = [];
    
    /**
     * 构造方法
     */

    public function __construct(Request $request)
    {
        $this->request = $request;       
        $this->init();
        $this->uid = $this->clientInfo['uid'];
    }

    /**
     * 初始化方法
     */

     public function init()
     {
         if($this->request->isOptions())
         {
            return self::returnMsg(200, 'success');
         }
         $oauth = new \app\api\auth\Oauth;
         return $this->clientInfo = $oauth->authenticate();
     }

     public function _empty()
     {
         return self::returnMsg(404, 'not found!');
     }
}