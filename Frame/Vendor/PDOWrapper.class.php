<?php
/**
 * 封装PDO类
 * User: mrlifang
 * Date: 17/5/4
 * Time: 下午8:33
 */

namespace Frame\Vendor;
use \PDO;
use \PDOException;

class PDOWrapper
{
    //数据库配置信息
    private $db_type; //数据库类型
    private $db_host;
    private $db_port;
    private $db_user;
    private $db_pass;
    private $db_name;
    private $charset;
    private $pdo = null;

    //构造方法: 初始化PDO
    public function __construct()
    {

        $this->db_type = $GLOBALS['config']["db_type"];
        $this->db_host = $GLOBALS['config']["db_host"];
        $this->db_port = $GLOBALS['config']["db_port"];
        $this->db_pass = $GLOBALS['config']["db_pass"];
        $this->db_name = $GLOBALS['config']["db_name"];
        $this->charset = $GLOBALS['config']["charset"];
        $this->db_user = $GLOBALS['config']["db_user"];

        //创建对象
        $this->connectDB();
        //设置PDO的报错模式:异常模式
        $this->setErrMode();

    }

    /*连接数据库方法*/
    private function connectDB(){
        try {
            $dsn = "{$this->db_type}:dbhost={$this->db_host};dbpost={$this->db_port};dbname={$this->db_name};charset={$this->charset}";
            $this->pdo = new PDO($dsn, $this->db_user, $this->db_pass);
        }catch(\PDOException $e){
            $this->showErr($e);
        }

    }

    /*设置PDO报错模式*/
    private function setErrMode(){
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    /*封装exec方法 insert update delete set */
    public function exec($sql){
        try{
            //执行sql语句
           $c = $this->pdo->exec($sql);
           return $c;
        }catch(PDOException $e){
            $this->showErr($e);
        }
    }

    /*获取一行数据*/
    public function fetchOne($sql){

        try {
            $PDOStatement = $this->pdo->query($sql);
            //获取结果集中的一行数据 返回一维数组
            $arr = $PDOStatement->fetch();
            return $arr;
        }catch(PDOException $e){
            $this->showErr($e);
        }

    }

    /*获取多行数据*/
    public function fetchAll($sql){

        try {
            $PDOStatement = $this->pdo->query($sql);
            //获取结果集中的多行数据 返回二维数组
            $arr = $PDOStatement->fetchAll();
            return $arr;
        }catch(PDOException $e){
            $this->showErr($e);
        }

    }

    /*获取记录数*/
    public function rowCount($sql){
        try {
            $PDOStatement = $this->pdo->query($sql);

            $Conunt = $PDOStatement->rowCount();
            return $Conunt;
        }catch(PDOException $e){
            $this->showErr($e);
        }

    }


    /*显示报错的方法*/
    private function showErr($e){
        $str = "PDO执行错误";
        $str .= "错误码:".$e->getCode();
        $str .= "<br>行号:".$e->getLine();
        $str .= "<br>文件:".$e->getFile();
        $str .= "<br>信息:".$e->getMessage();
        echo $str;exit();
    }

}