<?php

return [
    'timeZone' => env('APP_TIME_ZONE'),
    'language' => env('APP_LANGUAGE'),
    'name' => env('APP_NAME'),
    'bootstrap' => ['log', 'ideHelper', \app\core\EventBootstrap::class],
    'components' => [
        'ideHelper' => [
            'class' => 'Mis\IdeHelper\IdeHelper',
            'configFiles' => [
                'config/web.php',
                'config/common.php',
                'config/console.php',
            ],
        ],
        'requestId' => [
            'class' => \yiier\helpers\RequestId::class,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => env('DB_DSN'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'tablePrefix' => env('DB_TABLE_PREFIX'),
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV_PROD,
            'schemaCacheDuration' => 60,
            'schemaCache' => 'cache',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/core/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'exception.php',
                    ],
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yiier\helpers\FileTarget',
                    'levels' => ['error'],
                    'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION'],
                    'logFile' => '@app/runtime/logs/error/app.log',
                    'enableDatePrefix' => true,
                ],
                [
                    'class' => 'yiier\helpers\FileTarget',
                    'levels' => ['warning'],
                    'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION'],
                    'logFile' => '@app/runtime/logs/warning/app.log',
                    'enableDatePrefix' => true,
                ],
                [
                    'class' => 'yiier\helpers\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['request'],
                    'logVars' => [],
                    'maxFileSize' => 1024,
                    'logFile' => '@app/runtime/logs/request/app.log',
                    'enableDatePrefix' => true
                ],
                [
                    'class' => 'yiier\helpers\FileTarget',
                    'levels' => ['warning'],
                    'categories' => ['debug'],
                    'logVars' => [],
                    'maxFileSize' => 1024,
                    'logFile' => '@app/runtime/logs/debug/app.log',
                    'enableDatePrefix' => true
                ],
            ],
        ],
    ],
];
