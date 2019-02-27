<?php

namespace app\api\controller;
use app\api\controller\ApiController;
use think\Validate;
use app\api\model\Organization;

class OrganizationController extends ApiController
{
    /**
     * 创建机构
     */
    public function create()
    {
        $validate = new Validate([
            'logo' => 'require',
            'name' => 'require',
            'idcard' => 'require'
        ]);

        if(!$validate->check(input('')))
        {
            return self::returnMsg(200, $validate->getError());
        }
        $org = new Organization;
        $org->logo = input('logo');
        $org->name = input('name');
        $org->idcard = input('idcard');
        $org->tid = $this->uid;
        $org->save();
        return $org;
    }

    /**
     * 机构信息
     */
    public function info()
    {
        $org = Organization::get(['tid' => $this->uid]);
        return $org;
    }
}
