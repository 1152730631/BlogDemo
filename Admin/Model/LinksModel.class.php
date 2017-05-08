<?php
/**
 * 友情链接模型类
 * User: mrlifang
 * Date: 17/5/6
 * Time: 下午5:28
 */

namespace Admin\Model;


use Frame\Libs\BaseModel;

class LinksModel extends BaseModel
{
    //受保护的数据包名称
    protected $table = "links";

//    public function fetchAll(){
//        $sql = "SELECT * FROM $this->table ORDER BY id DESC";
//        return $this->pdo->fetchAll($sql);
//    }
//
//    /*
//     * 添加数据
//     */
//    public function insert($data){
//        $fields = "";
//        $values = "";
//
//        foreach($data as $key => $value){
//            $fields .= "$key,";
//            $values .=  "'$value',";
//        }
//
//        $fields = rtrim($fields,",");
//        $values = rtrim($values,",");
//
//        $sql = "INSERT into {$this->table}($fields) VALUES($values)";
//
//        return $this->pdo->exec($sql);
//
//    }
//
//    /*
//     * 删除一条数据
//     */
//    public function delete($id){
//        $sql = "DELETE FROM $this->table where id = $id";
//        return $this->pdo->exec($sql);
//    }
//
//    /*
//     * 更新一条记录
//     */
//    public function update($date,$id){
//        $fields = "";
//        foreach($date as $key => $value){
//            $fields .= "$key = '$value',";
//        }
//        $fields = rtrim($fields,",");
//        $sql = "UPDATE {$this->table} set $fields where id=$id";
//        return $this->pdo->exec($sql);
//    }
//
//    /*
//     * 获取一条数据
//     */
//    public function feachOne($where = "2>1"){
//        $sql = "SELECT * FROM links where $where LIMIT 1";
//        return $this->pdo->fetchOne($sql);
//    }

}