<?php

$config = [
    'db'=>[
            'host'     =>  '127.0.0.1',        // 服务器地址
            'db_user'  =>  'root',             // 数据库名
            'db_pwd'   =>  'root',             // 数据库名
            'db_name'  =>  'mvc_test',         // 数据库名
    ],
    'session'=>[
        'files'=>[],
        'memcache'=>[
            'path'    =>'tcp://127.0.0.1:11211',   //memcache的配置信息
            'handler' =>'memcache',                //权重
        ],
        'target'=>'memcache',                      //session的存储方式
                                                        //（memcache=>session存储在缓存中；files=>session存储在服务器的session文件中）
    ],
    'path'=>[
        1 => 'pathinfo',                         //pathinfo路由模式：如 http://www.mvc.net/index.php?c=index&a=test
        2 => 'url',                              //url正规路由模式： 如 http://www.mvc.net/index/test
        'target'=>1,                             //路由模式（1=>pathinfo模式；2=>url模式）
    ],

];