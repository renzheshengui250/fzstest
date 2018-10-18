<?php

/**
 * Class IndexModel  首页模型
 */
class IndexModel extends Model
{
    //定义表名
    public $tableName = "navigation";

    //导航查询
    public function navigation(){

        /**
         * 查询多条信息
         */
        return $this->where(['navigation_state'=>1])->select();//查询所有数据

    }
}