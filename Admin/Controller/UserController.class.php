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
use Frame\Vendor\Captcha;

class UserController extends BaseController
{
    public function index(){
        $this->denyAccess();
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
        $this->denyAccess();
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
        $this->denyAccess();
        $this->smarty->display("User".DS."add.html");
    }

    /*
     * 插入表单到数据库
     */
    public function insert(){
        $this->denyAccess();
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

    //用户登录的方法
    public function login(){
        $this->smarty->display("User".DS."login.html");
    }

    /*
     * 用户登录检测逻辑
     */
    public function loginCheck(){
        //(1) 获取表单提交值
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $verify = $_POST['verify'];
        $data['last_login_ip'] = $_SERVER['REMOTE_ADDR'];
        $data['last_login_time'] = time();

        //(2) 判断验证码输入是否正常
        if(strtolower($verify) != $_SESSION['captcha']){
            $this->jump("验证码格式错误","admin.php?c=User&a=login");
        }

        //(3) 判断用户输入的登录信息是否正确
        $user = UserModel::getInstance()->fetchOne("username = '$username' and password = '$password'");
        if (empty($user)) {
            $this->jump("用户名或者密码不正确!", "?c=User&a=login");
        }

        //(4)更新用户信息,最后登录的IP 最后登录的时间 登录次数
        UserModel::getInstance()->loginUpdate($data, $user['id']);

        //(5)将用户的必要信息存入SESSION
        $_SESSION['uid'] = $user['id']; //用户id
        $_SESSION['username'] = $user['username']; //用户名称

        //(4)跳转到后台管理首页
        $this->jump("用户登录成功", "admin.php?c=index");

    }

    /*
    * 生成验证码的方法
    */
    public function captcha(){
        //创建验证码的对象
        $c = new Captcha();
        //获取验证码的值 并且存入SESSION
        $_SESSION['captcha'] = $c->getCode();

    }

    /*
     * 用户退出功能的实现
     */
    public function logout(){
        unset($_SESSION['uid']);
        unset($_SESSION['username']);
        session_destroy();
        $this->$this->jump("老板再见!(～o￣3￣)～","admin.php?a=User&c=login");
    }

}