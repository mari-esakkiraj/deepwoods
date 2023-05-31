<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
//Yii::setAlias('@views', 'views');
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Io4kvrCw70pvoQYAvJVF5uRSImR_5GSj',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                'securitycheck' => 'sicattender/checkvalidation',
                'security' => 'site/login',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        /*'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'authenticator' => [
            'class' => \yii\filters\auth\HttpBearerAuth::class,
        ],*/
    
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            //'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => false,
            'transport' => [
                'scheme' => 'smtps',
                'host' => 'smtp.hostinger.com',
                'username' => 'info@deepwoodsorganics.com',
                'password' => 'Deep@$2023',
                'port' => 465,
                //'dsn' => 'sendmail://default',
                'encryption' => 'tls', 
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                ],
            ],
        ],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'formatter' => [
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            'currencyCode' => '₹'
        ]
    ],
    'params' => $params,
    'defaultRoute' => 'site/mainpage',
    'modules' => [
        'under-construction' => [
            'class' => '\mervick\underconstruction\Module',
            // this is the on off switch
            'locked' => false, 
            // the list of IPs that are allowed to access site.
            // The default value is `['127.0.0.1', '::1']`, which means the site can only be accessed by localhost.
            'allowedIPs' => [],
            // change this to your namespace, if you want use your own controller
            'controllerNamespace' => 'mervick\underconstruction\controllers', 
            // if you want use your views
            'viewPath' => '',
            // default layout
            'layout' => 'main', 
            // if you want redirect to external website, default is null
            'redirectURL' => 'http://example.com', 
        ],
    ],
    'bootstrap' => [
        'under-construction',
    ],
];

if (YII_ENV_DEV) 
{
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => [],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
