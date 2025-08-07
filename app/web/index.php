<?php

use yii\base\InvalidConfigException;

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod'/* 'dev' */);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$_SERVER['HTTPS'] = 'on';

$config = require __DIR__ . '/../config/web.php';

//(new yii\web\Application($config))->run();

/** @var string $e */
try {
    setlocale(LC_ALL, 'pt_BR.UTF8');
    mb_internal_encoding('UTF8');
    mb_regex_encoding('UTF8');
   // setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    (new yii\web\Application($config))->run(); 
} catch (InvalidConfigException $e) {
    throw new InvalidConfigException($e);
}