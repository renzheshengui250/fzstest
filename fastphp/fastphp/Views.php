<?php


class Views
{
    public $_assign = [];       //控制器中assign发送的数据
    private $_controName;       //控制器名称
    private $_actionName;       //控制器名称
    public function __construct($controName,$actionName)
    {
        $this->_controName = $controName;       //控制器名称
        $this->_actionName = $actionName;       //方法名称
    }

    /**
     * 渲染数据
     * @param $keys   //数据键
     * @param $values //数据值
     */
    public function assign($keys,$values)
    {
        $this->_assign[$keys] = $values;
    }

    /**
     * 渲染模板
     * $file_name  染的文件名称
     */
    public function display($file_name = "")
    {
        //向哈希表中存放信息
        extract($this->_assign);

        //对模板文件进行判断
        $file_name = $file_name ? $file_name : $this->_actionName;

        //引入模板文件
        require APP_PATH."application/views/{$this->_controName}/$file_name";
    }
}