<?php


class Model extends Sql
{

    public $whereCondition;
    /**
     * 添加记录方法
     */
    public function insert($data){
        return $this->insertRecord($data);
    }

    /**
     * 删除记录方法
     */
    public function delete($condition = ""){
        return $this->deleteRecord($condition);
    }

    /**
     * 修改记录方法
     */
    public function update($value = ""){
        return $this->updateRecord($value);
    }

    /**
     * 查询所有记录方法
     */
    public function select($condition = ""){
        return $this->selectRecord($condition);
    }

    /**
     * 查询单条记录方法
     */
    public function find($condition = ""){
        return $this->findRecord($condition);
    }

    /**
     * 执行原生SQL
     */
    public function query($sql){
        return $this->querySql($sql);
    }

    /**
     * 执行where条件
     */
    public function where($where = ""){
        $this->whereCondition = $where;
        return $this;
    }
}