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

    public function __construct()
    {
        $this->pdo = new PDOWrapper();
    }

}