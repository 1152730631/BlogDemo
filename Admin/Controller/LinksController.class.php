<?php
/**
 * Created by PhpStorm.
 * User: mrlifang
 * Date: 17/5/8
 * Time: 下午9:39
 */

namespace Admin\Controller;


use Admin\Model\LinksModel;
use Frame\Libs\BaseController;

class LinksController extends BaseController
{
    /**
     * 友情链接首页
     */
    public function index(){
        $this->denyAccess();
        //获取数据
        $links = LinksModel::getInstance()->fetchAll();
        $this->smarty->assign('links',$links);
        $this->smarty->display("Links".DS."index.html");
    }
    /**
     * 添加友情链接
     */
    public function add(){
        $this->denyAccess();
        $this->smarty->display("Links".DS."add.html");
    }

    /**
     * 添加友情链接
     */
    public function insert(){
        $this->denyAccess();
        $data['domain'] = $_POST['domain'];
        $data['url'] = $_POST['url'];
        $data['orderby'] = $_POST['orderby'];

        if(LinksModel::getInstance()->insert($data)){
            $this->jump("链接添加成功","admin.php?c=links&a=index");
        }else{
            $this->jump("链接添加失败","admin.php?c=links&a=add");
        }
    }

    /*
     * 删除链接
     */
    public function delete(){
        $this->denyAccess();
        $id = $_GET['id'];

        if(LinksModel::getInstance()->delete($id)){
            $this->jump("链接删除成功","admin.php?c=links&a=index");
        }else {
            $this->jump("链接删除失败","admin.php?c=links&a=index");
        }

    }

    /*
     * 显示修改链接界面
     */
    public function edit(){
        $this->denyAccess();
        $id = $_GET['id'];

        $link = LinksModel::getInstance()->fetchOne("id = $id");
        $this->smarty->assign("link",$link);
        $this->smarty->display("Links".DS."edit.html");
    }
    /*
     * 更新链接数据方法
     */
    public function update(){
        $this->denyAccess();

        $date['domain'] = $_POST['domain'];
        $date['url'] = $_POST['url'];
        $date['orderby'] = $_POST['orderby'];


        if(LinksModel::getInstance()->update($date,$_POST['id'])){
            $this->jump("链接更新成功","?c=links&a=index");
        }else{
            $this->jump("链接更新失败","?c=links&a=index");
        }
    }

}