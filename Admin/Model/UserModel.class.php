<?php
/**
 * Created by PhpStorm.
 * User: mrlifang
 * Date: 17/5/8
 * Time: 下午7:55
 */

namespace Admin\Model;


use Frame\Libs\BaseModel;

class UserModel extends BaseModel
{
    protected $table = "user";

    public function loginUpdate($data, $id){

        $str = "";
        foreach($data as $key => $value){
            $str .= "$key = '$value',";
        }
        $str = rtrim($str,",");
        $sql = "UPDATE user SET $str WHERE id = $id";
        return $this->pdo->exec($sql);
    }

}