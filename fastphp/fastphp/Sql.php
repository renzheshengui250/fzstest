<?php


class Sql
{
    public static $_config;
    public $pdo;

    //链接数据库
    public function __construct()
    {
        $host    = self::$_config['db']['host'];
        $db_user = self::$_config['db']['db_user'];
        $db_pwd  = self::$_config['db']['db_pwd'];
        $db_name = self::$_config['db']['db_name'];

        //连接数据库
        $this->pdo = new PDO("mysql:host={$host};dbname={$db_name}","{$db_user}","{$db_pwd}");
    }

    /**
     * 处理SQL语句
     * $arr   数据组
     * 操作的类型：如添加时类型为",";修改时类型为"AND"
     */
    public function handleSql($data,$opType){
        $sql = "";
        foreach($data as $key => $val){
            if(is_numeric($val)){
                $sql .= "{$key} = {$val} $opType";
            }else{
                $sql .= "{$key} = '{$val}' $opType";
            }
        }

        //返回SQL
        return trim($sql,$opType);
    }

    /**
     * 执行添加
     */
    public function insertRecord($data){
        $opType = ",";

        $handleSql = $this->handleSql($data,$opType);
        //数据表
        $tableName = $this->tableName;
        $handleSql = "INSERT INTO {$tableName} SET $handleSql";

        return $this->queryRecord($handleSql,"exec");
    }
    /**
     * 执行删除
     * $condition  -->delete方法里的条件组
     */
    public function deleteRecord($condition = ""){
        /**
         * 调用where拼接方法，获取where方法中的值
         */
        $where = $this->wherePort();

        /**
         *调用confition判断方法，获取delete、update、find/select方法中的值
         */
        $where .= $this->conditionPort($condition);

        //拼接最终的SQL
        $handleSql = "DELETE FROM {$this->tableName}" . $where;

        $this->saveLog($handleSql); //存储日志
        return $this->queryRecord($handleSql,"exec");
    }

    /**
     * 执行修改
     * $value  update方法里的更改信息组
     */
    public function updateRecord($value){
        /**
         * 调用where拼接方法，获取where方法中的值
         */
        $where = $this->wherePort();

        //处理update方法里的信息组
        $valueSql = $this->handleSql($value,", ");

        //拼接最终的SQL
        $handleSql = "UPDATE {$this->tableName} SET {$valueSql}".$where;

        $this->saveLog($handleSql);   //存储日志
        return $this->queryRecord($handleSql,"exec");
    }

    /**
     * 执行查询多条数据
     */
    public function selectRecord($condition = ""){
        /**
         * 调用where拼接方法，获取where方法中的值
         */
        $where = $this->wherePort();

        /**
         *调用confition判断方法，获取delete、update、find/select方法中的值
         */
        $where .= $this->conditionPort($condition);
        //拼接最终的SQL
        $handleSql = "SELECT * FROM {$this->tableName}".$where;

        $this->saveLog($handleSql);   //存储日志
        return $this->queryRecord($handleSql,"query","all");
    }

    /**
     * 执行单条信息查询
     */
    public function findRecord($condition = ""){
        /**
         * 调用where拼接方法，获取where方法中的值
         */
        $where = $this->wherePort();

        /**
         *调用confition判断方法，获取delete、update、find/select方法中的值
         */
        $where .= $this->conditionPort($condition);
        //拼接最终的SQL
        $handleSql = "SELECT * FROM {$this->tableName}".$where;

        $this->saveLog($handleSql);  //存储日志
        return $this->queryRecord($handleSql,"query","one");
    }
    /*------------------------------------ 条件片段块 ------------------------------------*/
    /**
     * conditionPort
     * wherePort
     */


    /**
     * 判断delete、update、find/select方法中的条件
     * （1）是否为空
     * （2）是否是数组
     * （3）是否是字符串
     */
    public function conditionPort($condition){
        if($condition == ""){
            return "";
        }elseif(is_array($condition)){
            return " AND ".$this->handleSql($condition,"AND ");
        }elseif (is_string($condition)){
            return " AND ".$condition;
        }
    }

    /**
     * where条件记录
     */
    public function wherePort(){
        $where = " WHERE 1 = 1 ";
        //接收where条件中的值
        $whereCondtion = $this->whereCondition;
        //判断where条件
        if($whereCondtion == ""){
            return $where .="";
        }elseif(is_array($whereCondtion)){
            return $where .= " AND ".$this->handleSql($whereCondtion,"AND ");
        }elseif (is_string($whereCondtion)){
            return $where .= " AND ".$whereCondtion;
        }
    }
    /*------------------------------------ 条件片段块 ------------------------------------*/
    /**
     * 执行最终的SQL语句
     *
     */
    public function queryRecord($handleSql = "",$type = "",$range = ""){
        if($range == "one"){
            return $this->pdo->$type($handleSql)->fetch(PDO::FETCH_ASSOC);
        }elseif($range == "all"){
            return $this->pdo->$type($handleSql)->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return $this->pdo->$type($handleSql);
        }
    }

    /**
     * 执行原生SQL语句
     */
    public function querySql($sql){
        $this->saveLog($sql);
        $idea = explode(" ",$sql)[0];
        if(strtoupper($idea) == "SELECT"){
            return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return $this->pdo->exec($sql);
        }
    }

    /**
     * 存储log日志
     */
    public function saveLog($handleSql){
        $logPath = APP_PATH . "log/log.txt";
        $content = $handleSql . " ------ " .date("Y-m-d H:i:s");
        file_put_contents($logPath,$content . PHP_EOL,FILE_APPEND);
    }
}