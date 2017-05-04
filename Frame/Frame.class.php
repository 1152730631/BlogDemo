<?php

/**
 * Created by PhpStorm.
 * User: mrlifang
 * Date: 17/5/4
 * Time: 下午6:39
 */
namespace Frame;

final class Frame
{
    //公共的静态的初始化方法
    public static function run(){
        self::initCharset();    //①网页字符集设置
        self::initConfig();     //②初始化配置文件
        self::initRoute();      //③获取路由参数
        self::initConst();      //④常用常量的设置
        self::initAutoLoad();   //⑤类的自动加载
        self::initDispatch();   //⑥请求分发

    }
    /*①网页字符集设置*/
    private static function initCharset(){
        header("content-type:text/html;charset=utf-8");
    }
    /*②初始化配置文件*/
    private static function initConfig(){
        $GLOBALS["config"] = require_once(APP_PATH.DS."Conf".DS."Config.php");

    }
    /*③获取路由参数*/
    private static function initRoute(){
        $p =  $GLOBALS["config"]["default_platform"];
        $c = isset($_GET['c']) ? $_GET["c"] : $GLOBALS["config"]["default_controller"];
        $a = isset($_GET['a']) ? $_GET['a'] : $GLOBALS["config"]["default_action"];

        //将参数转换成常量方便其他方法调用
        define("PLAT",$p);
        define("CONTROLLER",$c);
        define("ACTION",$a);
    }
    /*④常用常量的设置*/
    private static function initConst(){
        define("VIEW_PATH",APP_PATH."View".DS.CONTROLLER.DS);//添加视图路径常量//blogdemo/Home/View
    }
    /*⑤类的自动加载*/
    private static function initAutoLoad(){
        spl_autoload_register(function($className){
            $filename = ROOT_PATH.str_replace("\\",DS,$className).".class.php";

            if(file_exists($filename)){
                require_once($filename);
            }
        });
    }
    /*⑥请求分发 创建什么控制器对象,调用控制器的什么方法*/
    private static function initDispatch(){
        //构建控制器类名
        $c = "\\".PLAT."\\"."Controller"."\\".CONTROLLER."Controller"; //\Home\Controller\NewsController

        //创建控制器类对象
        $controllerObj = new $c;

        $a = ACTION;

        //调用控制器对象的方法
        $controllerObj->$a();

    }

}