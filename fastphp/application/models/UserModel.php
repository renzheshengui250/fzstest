<?php

/**
 * Class UserModel    用户模型
 */
class UserModel extends Model
{
    //定义表名
    public $tableName = "user";

    //创建用户方法
    public function create(){
        /**
         * 添加信息
         * 以数组形式添加
         */
//        return $this->insert(['name'=>"封泽生",'sex'=>1]);
        /**
         * 删除信息
         * delete([删除的条件])
         */
//        return $this->delete(['name'=>"鲁智深",'sex'=>2]);
//        return $this->where('id = 1')->delete();
//        return $this->where(['name'=>"封泽生",'sex'=>1])->delete();

        /**
         * 修改信息
         * update([需要更改的值])
         */
//        return $this->where(['age'=>33])->update(['name'=>"鲁3智深",'sex'=>2]);
//        return $this->where("id = 1")->update(['name'=>"鲁智32深",'sex'=>5]);
        /**
         * 查询单条信息
         * find([查询的条件])
         * 查询的条件可以是
         *       （1）字符串：查询符合字符串条件的信息
         *       （2）数组：  查询符合数组条件的信息
         */
//        return $this->where(['id'=>2,'name'=>"封泽生"])->find();//查询单条数据
//        return $this->where("id = 2 and name = '封泽生'")->find();//查询单条数据
//        return $this->find("id = 2 and name = '封泽生'");//查询单条数据
//        return $this->find(['id'=>5]);//查询单条数据
        /**
         * 查询多条信息
         * select([查询的条件])
         * 查询的条件可以是
         *       （1）空：    代表查询所有
         *       （2）字符串：查询符合字符串条件的信息
         *       （3）数组：  查询符合数组条件的信息
         */
//        return $this->where(['id'=>2,'name'=>"封泽生"])->select();//查询所有数据
//        return $this->where("id >= 1 and id < 5")->select();//查询所有数据
//        return $this->select(['id'=>1]);//查询所有数据
//        return $this->select("id >= 1");//查询所有数据
        return $this->select();//查询所有数据

        /**
         * 执行原生SQL语句
         * query(执行的原生SQL)
         *
         */
//        return $this->query("select * from user where id > 1");//查询所有数据

    }
}