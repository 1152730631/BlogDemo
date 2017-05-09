<?php
/**
 * Created by PhpStorm.
 * User: mrlifang
 * Date: 17/5/4
 * Time: 下午7:15
 */
namespace Admin\Controller;

use Admin\Model\IndexModel;
use Frame\Libs\BaseController;

class IndexController extends BaseController{

    public function index(){
          $this->denyAccess();
//        $modelObj = IndexModel::getInstance();
//        $arrs = $modelObj->fetchAll();
//
//        //向视图赋值,并调用视图显示
//        $this->smarty->assign("arrs",$arrs);
        $this->smarty->display("Index".DS."index.html");
    }

    /*
     * 顶部视图
     */
    public function top(){
        $this->denyAccess();
        $this->smarty->display("Index".DS."top.html");
    }

    /*
     * 左侧视图
     */
    public function left(){
        $this->denyAccess();
        $this->smarty->display("Index".DS."left.html");
    }
    /*
     * 中部视图
     */
    public function center(){
        $this->denyAccess();
        $this->smarty->display("Index".DS."center.html");
    }
    /*
     * 主框架视图文件
     */
    public function main(){
        $this->denyAccess();
        $this->smarty->display("Index".DS."main.html");
    }
}