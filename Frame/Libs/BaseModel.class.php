<?php
/**
 * 基础的Model类
 * User: mrlifang
 * Date: 17/5/4
 * Time: 下午9:05
 */

namespace Frame\Libs;

use Frame\Vendor\PDOWrapper;

abstract class BaseModel
{

    protected $pdo = null;

    //受到保护的模型类对象数组
    protected static $modelObjArr = array();

    //公共的构造方法
    public function __construct()
    {
        $this->pdo = new PDOWrapper();

    }

    /*模型类单例方法 一个模型类只能创建一个对象*/
    /**
     * @param $className
     * @return mixed
     */
    public static function getInstance(){
        /*
         * $modelObjArr['StudentModel'] = StudentModel对象
         * */
        $className = get_called_class(); //获取静态化方式调用的类名称
        //判断模型类对象是否存在
        if(!isset(self::$modelObjArr[$className])) {
            self::$modelObjArr[$className] = new $className();
        }

        //如果模型类对象存在 直接返回
        return self::$modelObjArr[$className];
    }

    /*
    * 获取多行数据
    */
    public function fetchAll(){
        $sql = "SELECT * FROM $this->table ORDER BY id DESC";
        return $this->pdo->fetchAll($sql);
    }

    /*
     * 删除记录
     */
    public function delete($id){
        $sql = "DELETE FROM $this->table where id = $id";
        return $this->pdo->exec($sql);
    }

    /*
     * 插入一条记录
     */
    public function insert($data){
        $fields = "";
        $values = "";

        foreach($data as $key=>$value){
            $fields .= $key.",";
            $values .= "'".$value."'".",";
        }

        $fields = rtrim($fields,",");
        $values = rtrim("$values",",");

        //构建插入的sql语句
        $sql = "INSERT INTO $this->table($fields) values($values)";
        return $this->pdo->exec($sql);
    }

    /*
     * 获取记录数
     */
    public function rowCount($where = "2>1"){
        $sql = "SELECT * FROM $this->table where $where";
        return $this->pdo->rowCount($sql);
    }

    /*
     * 获取一行数据
     */
    public function fetchOne($where = "2>1"){
        $sql = "SELECT * FROM $this->table WHERE $where";
        return $this->pdo->fetchOne($sql);
    }

    /*
     * 执行SQL语句的方法
     */
    public function exec($date){
        $fields = "";

        foreach($date as $key=>$value){
            $fields .= $key." = "."'$value'".",";
        }

        $fields = rtrim($fields,",");

        $sql = "UPDATE $this->table set $fields where id = {$date['id']}";
        return $this->pdo->exec($sql);

    }

    /*
     * 更新一条记录
     */
    public function update($date,$id){
        $fields = "";
        foreach($date as $key => $value){
            $fields .= "$key = '$value',";
        }
        $fields = rtrim($fields,",");
        $sql = "UPDATE {$this->table} set $fields where id=$id";
        return $this->pdo->exec($sql);
    }

}