<?php

namespace app\api\controller;
use think\Controller;
use app\api\model\Teacher;
use think\Request;
use app\api\controller\ApiController;
use think\Validate;

class TeacherController extends ApiController {

    public function info(Request $request)
    {
        $teacher = Teacher::get(['id' => $this->uid]);
        return $teacher;
    }
    
    public function editInfo(Request $request)
    {
        $validate = new Validate([
            'avatar' => 'require',
            'name' => 'require'
        ]);

        if(!$validate->check(input('')))
        {
            return self::returnMsg(200, $validate->getError());
        }
        $teacher = Teacher::get(['id' => $this->uid]);
        $teacher->name = input('name');
        $teacher->avatar = input('avatar');
        $teacher->save();       
        return $teacher;
    }
}
