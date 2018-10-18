<?php

/**
 * Class IndexModel  首页模型
 */
class CaseModel extends Model
{
    //定义表名
    public $tableName = "case_app";

    //导航查询
    public function case_list(){

        /**
         * 查询多条信息
         */
        return $this->where("case_state = 1")->select();//查询所有数据

    }
}