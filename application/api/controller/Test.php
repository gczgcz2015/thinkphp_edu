<?php

namespace app\api\controller;
use think\Controller;
use think\Db;

class Test extends Controller {
    public function index() {
        return Db::query('select * from think_user where id=?',[8]);
    }
}
