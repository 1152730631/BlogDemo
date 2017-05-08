<?php
/**
 * Created by PhpStorm.
 * User: mrlifang
 * Date: 17/5/4
 * Time: 下午7:15
 */
namespace Home\Controller;

use Home\Model\IndexModel;

class IndexController{

    public function index(){
        $modelObj = new IndexModel();
        $arrs = $modelObj->fetchAll();

    }

}