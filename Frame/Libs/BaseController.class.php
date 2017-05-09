<?php
/**
 * Created by PhpStorm.
 * User: mrlifang
 * Date: 17/5/7
 * Time: 下午9:46
 */

namespace Frame\Libs;


use Frame\Vendor\Smarty;

class BaseController
{

    //受保护的Smarty 对象属性
    protected $smarty = null;

    //构造方法:初始化工作
    public function __construct()
    {
        $this->initSmarty();

    }

    /*初始化Smarty*/
    protected function initSmarty(){

        //(1)创建Smarty对象
        $smarty = new Smarty();
        //(2) Smarty的配置
        $smarty->left_delimiter = "<{";   //左定界符号
        $smarty->right_delimiter = "}>";  //右定界符号
        $smarty->setTemplateDir(VIEW_PATH); //设置视图目录
        $smarty->setCompileDir(sys_get_temp_dir()); //设置编译临时目录
        //(3)将$smarty赋值给$this->$smarty
        $this->smarty = $smarty;

    }

    /*跳转方法*/
    protected function jump($message, $url = "?", $time = 3)
    {
//        echo $msg;
//        //跳转到列表页
//        header("refresh:{$tiem};url={$url}");
//        exit();
        //使用以下一行代码替代上面三行代码
        //向视图文件jump.html赋值
        $this->smarty->assign(
            array(
            'message' => $message,
            'url' => $url,
            'time' => $time
        ));

        $this->smarty->display("Public" . DS . "jump.html");
        exit();
    }

    /**
     * 权限验证
     */
    protected function denyAccess()
    {
        //判断用户是否登录
        if (!isset($_SESSION['username'])) {
            //跳转到登录界面
            $this->jump("你TMD登录去!!!!", "admin.php?c=User&a=login");
        }
    }




}