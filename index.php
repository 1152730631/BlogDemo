<?php
/**
 * 前端应用入口文件
 * User: mrlifang
 * Date: 17/5/4
 * Time: 下午6:41
 */

//常用常量的设置
define("DS",DIRECTORY_SEPARATOR);                //目录分隔符,动态的
define("ROOT_PATH",getcwd().DS);                //网站根目录
define("APP_PATH",ROOT_PATH."Home".DS);         //应用目录

//① 包含框架初始类文件
require_once (ROOT_PATH.DS."Frame".DS."Frame.class.php");

//② 调用初始化框架类的方法 注意命名空间加入空间路径名
\Frame\Frame::run();