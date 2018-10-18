<?php

/**
 * fastphp框架核心
 */

class Fastphp
{
    public $_config;
    public function __construct($config)
    {
        $this->_config = $config;
    }

    public function run(){
        spl_autoload_register([$this,'loadClass']);
        //Model是个什么情况？
        Model::$_config = $this->_config;
        $this->setReporting();       //dbug错误调试
        $this->removeMagicQuotes();  //检测敏感字符并删除
        $this->route();
    }

    /**
     * 处理路由
     */
    public function handelRoute(){
        $type = $this->_config['path']['target'];  //获取自定义的路由模式（类型）
        $type = $this->_config['path'][$type];     //获取对应的路由

        $url = $_SERVER['REQUEST_URI'];
        //判断用户自定义的路由模式
        if($type == 'pathinfo') {
            $url = trim($url,"/");
            $arrUrl = explode("?",$url);
            $arrInfo = $arrUrl[1];
            $secondInfo = explode("&",$arrInfo);

            foreach($secondInfo as $key => $val){
                $arrTemp[] = explode("=",$val)[1];
            }

            //控制器名转换成大写
            $controName = ucfirst($arrTemp[0]);
            //方法名
            $actionName = $arrTemp[1];
        }elseif($type == 'url'){
            $url = trim($url,'/');
            $url = explode("/",$url);
            $controName = !empty($url[0]) ? $url[0] : "index";
            $actionName = !empty($url[1]) ? $url[1] : "test";
        }
        //定义存放控制器和方法的数组
        return $routeArr = [
            'controName' => $controName,
            'actionName' => $actionName,
        ];
    }
    //路由方法
    public function route(){
        $routeArr = $this->handelRoute();
        $controName = $routeArr['controName'];
        $actionName = $routeArr['actionName'];
        $obj = new $controName($controName,$actionName);
        call_user_func_array(array($obj, $actionName), []);
    }

    /**
     * 检测敏感字符并删除
     */
    public function removeMagicQuotes()
    {
        $_GET     = isset($_GET)     ? $this->stripSlashesDeep($_GET )    : "";
        $_POST    = isset($_POST)    ? $this->stripSlashesDeep($_POST )   : "";
        $_COOKIE  = isset($_COOKIE)  ? $this->stripSlashesDeep($_COOKIE)  : "";
        $_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : "";
    }

    /**
     * 删除敏感字符
     * $value
     */
    public function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map(array($this, 'stripSlashesDeep'), $value) : stripslashes($value);
        return $value;
    }


    /**
     * 检测开发环境
     */
    public function setReporting()
    {

        if (APP_DEBUG === true) {

            error_reporting(E_ALL);

            ini_set('display_errors','On');

        } else {

            error_reporting(E_ALL);

            ini_set('display_errors','Off');

            ini_set('log_errors', 'On');

        }

    }

    //自动加载控制器和模型类
    //如果你在框架里面new一个类的时候
    //1、核心类库
    public function loadClass($class){
        //1、找到框架目录
        $freamkwork  = APP_PATH . "/fastphp/" . $class . ".php";

        $controllers = APP_PATH . "application/controllers/" . $class . ".php";

        $models      = APP_PATH . "application/models/" . $class . ".php";
        $views       = APP_PATH . "application/views/" . $class . ".php";
        $classes     = APP_PATH . "classes/" . $class . ".php";
        if(file_exists($freamkwork)){
            include $freamkwork;
        }elseif (file_exists($controllers)){
            include $controllers;
        }elseif (file_exists($models)){
            include $models;
        }elseif (file_exists($views)){
            include $views;
        }elseif(file_exists($classes)){
            include $classes;
        }
    }

    private function save(){
        $arr = $this->_config;
        $target = $arr['session']['target'];
        $arrInfo = $arr['session'][$target];
        // print_r($arrInfo);die;
        if(is_array($arrInfo) && !empty($arrInfo)){
            $path = $arr['session'][$target]['path'];
            $handler = $arr['session'][$target]['handler'];
            // echo $handler;die;
            ini_set('session.save_path',$path);
            ini_set('session.save_path',$handler);
        }

    }

}