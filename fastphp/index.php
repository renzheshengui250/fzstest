<?php

// 应用目录为当前目录
define('APP_PATH', __DIR__ . '/');

// 开启调试模式
define('APP_DEBUG', true);

// 加载配置文件
require(APP_PATH . 'config/config.php');

// 加载框架入口文件
require(APP_PATH . 'fastphp/fastphp.php');

// 实例化框架类  启动框架
$fastphp = new Fastphp($config);
$fastphp->run();