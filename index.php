<?php
//namespace buffet;
//phpinfo();die;
// 自动加载
require_once __DIR__ . '/vendor/autoload.php';

defined(APP_DEBUG) ?: define('APP_DEBUG', true);


$app = new app\core\App();

$app->run();


