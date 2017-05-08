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
     * 删除方法
     */
    public function delete(){
        $id = $_GET['id'];

        //创建用户模型类对象
        $modelObj = UserModel::getInstance();
        //调用模型类对象的fetchAll()方法返回所有的用户信息
        if($modelObj->delete($id)){
            $this->jump("id={$id}的用户删除成功","?c=User&a=index");
        }else{
            $this->jump("id={$id}的用户删除失败","?c=User&a=index");
        }

    }

    /*
     * 显示添加用户的表单
     */
    public function add(){
        $this->smarty->display("User".DS."add.html");
    }

    /*
     * 插入表单到数据库
     */
    public function insert(){

        //获取表单提交值
        //判断用户名是否存在
        $username = $_POST['username'];
        $records = UserModel::getInstance()->rowCount("username="."'$username'");
        if($records){
            $this->jump("用户名{$username}已经被注册了");
        }

        $data['username'] = $_POST['username'];
        if($_POST['password'] != $_POST['confirmpwd']){
            $this->jump("两次输入的密码不一致");
        }

        $data['password'] = md5($_POST['password']);
        $data['name'] = $_POST['name'];
        $data['tel'] = $_POST['tel'];
        $data['status'] = $_POST['status'];

        //调用模型类对象写入方法写入数据

        if (UserModel::getInstance()->insert($data)){
            $this->jump("用户注册成功","?c=User&a=index");
        }else {
            $this->jump("用户注册失败","?c=User&a=add");
        }

    }





}