<?php
/**
 * Created by PhpStorm.
 * User: mrlifang
 * Date: 17/5/8
 * Time: 下午7:52
 */

namespace Admin\Controller;


use Admin\Model\UserModel;
use Frame\Libs\BaseController;

class UserController extends BaseController
{
    public function index(){
        $modelObj = UserModel::getInstance();

        //调用模型类对象的fetchAll()方法返回所有的用户信息
        $users = $modelObj->fetchAll();

        //向视图赋值并显示视图
        $this->smarty->assign("users",$users);
        $this->smarty->display("User".DS."index.html");
    }

    /*
     *
     */




}