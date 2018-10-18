<?php
/**
* cookie工具
*/
class Cookie
{
    /**
     * cookie 的设置
     * @param $key    cookie  键
     * @param $value  cookie  值
     * @param $time   cookie  过期时间
     */
	public function set($key,$value){
		setcookie($key,$value);
	}

    /**
     * cookie的获取
     * @param $key
     * @return mixed
     */
	public function get($key){
		return $_COOKIE["$key"];
	}

    /**
     * cookie的删除
     * @param $key
     */
	public function del($key){
		setcookie("$key", "", time()-3600);
	}
}
?>