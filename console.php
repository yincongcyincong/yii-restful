<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
	'mailer' => [  
            'class' => 'yii\swiftmailer\Mailer',  
            'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
            'transport' => [  
                'class' => 'Swift_SmtpTransport',  
                'host' => 'smtp.163.com',  //每种邮箱的host配置不一样
                'username' => '18208182393@163.com',  
                'password' => 'y1nc0ng',  
                'port' => '994',  
                'encryption' => 'ssl',          
                ],   
            'messageConfig'=>[  
                'charset'=>'UTF-8',  
                'from'=>['18208182393@163.com'=>'admin']  
                ],  
        ],
	'authManager' => [
   	    'class' => 'yii\rbac\DbManager',
   	    'itemTable' => 'auth_item',
  	    'assignmentTable' => 'auth_assignment',
   	    'itemChildTable' => 'auth_item_child',
	    'ruleTable' => 'auth_rule',
	],
    ],
    'params' => $params,

    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
