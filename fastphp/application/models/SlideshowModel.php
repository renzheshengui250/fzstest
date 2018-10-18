<?php

/**
 * Class IndexModel  首页模型
 */
class SlideshowModel extends Model
{
    //定义表名
    public $tableName = "slideshow";

    //导航查询
    public function slideshow(){

        /**
         * 查询多条信息
         */
        return $this->where(['slide_state'=>1])->select();//查询所有数据

    }
}