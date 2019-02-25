<?php

namespace app\api\controller;
use think\Controller;
use think\Db;
use app\api\model\Teacher;
use think\Request;

class TeacherController extends Controller {
    public function index(Request $request) {
        // return Db::query('select * from think_user where id=?',[8]);
        // return 'xxxx';
        return $request->param();
        $user = new Teacher;
        $user->name= 'thinkphp';
        $user->save();
        return $user;
    }
}
