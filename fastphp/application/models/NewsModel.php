<?php

/**
 * Class IndexModel  首页模型
 */
class NewsModel extends Model
{
    //定义表名
    public $tableName = "news";

    //新闻
    public function news(){

        /**
         * 查询多条信息
         */
        return $this->where(['news_state'=>1])->select();//查询所有数据

    }
}