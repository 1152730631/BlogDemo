<?php

/**
 * Created by PhpStorm.
 * User: mrlifang
 * Date: 17/5/4
 * Time: 下午7:32
 */
namespace Home\Model;
use Frame\Libs\BaseModel;

final class IndexModel extends BaseModel
{

    //获取多行数据
    public function fetchAll()
    {
        //构建查询的SQL语句
        $sql = "SELECT * FROM student order by id";
        //执行SQL 返回二维数组
        return $this->pdo->fetchAll($sql);

    }
}