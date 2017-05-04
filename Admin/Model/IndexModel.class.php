<?php

/**
 * Created by PhpStorm.
 * User: mrlifang
 * Date: 17/5/4
 * Time: 下午7:32
 */
namespace Admin\Model;
use \PDO;

final class IndexModel
{
    //数据库的配置信息
    private $dsn = "mysql:dbhost=localhost;dbpost=3306;dbname=itcast;charset=utf8";
    private $username = "root";
    private $password = "12345";

    //私有的保存数据库对象的属性
    private $db = null;

    //公共的构造方法
    public function __construct()
    {   //创建数据库对象
        $this->db = new PDO($this->dsn, $this->username, $this->password);
    }

    //获取多行数据
    public function fetchAll()
    {
        //构建查询的SQL语句
        $sql = "SELECT * FROM student order by id";
        //执行SQL 返回二维数组

        $PDOStatement = $this->db->query($sql);
        //③ 获取多行数据
        $arr = $PDOStatement->fetchAll(PDO::FETCH_NUM);
        return $arr;
    }
}