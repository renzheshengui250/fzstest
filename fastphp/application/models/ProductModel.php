<?php

/**
 * Class IndexModel  首页模型
 */
class ProductModel extends Model
{
    //定义表名
    public $tableName = "product";

    //导航查询
    public function product(){

        /**
         * 查询多条信息
         */
        return $this->where(['product_state'=>1])->select();//查询所有数据

    }
}