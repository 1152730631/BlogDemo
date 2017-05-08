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

}