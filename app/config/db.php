<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 
    (YII_ENV_DEV) ?
    'mysql:host=mariadb;dbname=mcmv_mcmv_pro;':
    'mysql:host=localhost;dbname=mcmv_mcmv;',
    'username' => 'mcmv_mcmv',
    'password' => 'mcmvcerveja123@',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'on afterOpen' => function ($event) {
        // set 'Asia/Bangkok' timezone
        $event->sender->createCommand("SET time_zone='-03:00';")->execute();
    },





    //    'class' => 'yii\db\Connection',
    //    'dsn' => 'pgsql:host=localhost;port=5432;dbname=mcmv',
    //    'username' => 'mcmv',
    //    'password' => 'mcmv123@',
    //    'charset' => 'utf8',
    //    'enableSchemaCache' => true,
    //    // Duration of schema cache.
    //    'schemaCacheDuration' => 3600,
    //    // Name of the cache component used to store schema information
    //    'schemaCache' => 'cache',
    //    'schemaMap' => [
    //        'pgsql' => [
    //            'class' => 'yii\db\pgsql\Schema',
    //            'defaultSchema' => 'mcmv' //specify your schema here
    //        ]
    //    ],
];
