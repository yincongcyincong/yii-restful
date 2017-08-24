<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'a5ttUHhtlgNyIAaYjnKRs3b28M9lywje',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
      	'authManager' => [
                  'class' => 'yii\rbac\DbManager',
                  'itemTable' => 'auth_item',
                  'assignmentTable' => 'auth_assignment',
                  'itemChildTable' => 'auth_item_child',
                  'ruleTable' => 'auth_rule',
              ],
      	'mailer' => [  
      	   'class' => 'yii\swiftmailer\Mailer',  
         	   'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
      	   'transport' => [  
      		'class' => 'Swift_SmtpTransport',  
             		'host' => 'smtp.163.com',  //每种邮箱的host配置不一样
             		'username' => '18208182393@163.com',  
             		'password' => 'y1nc0ng',
             		'port' => '25',  
             		'encryption' => 'tls',             
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
      	    'ruleTable' => 'auth_rule'
      	],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
	  //  'enableStrictParsing' => true,
            'rules' => [
    		    [
          		'class' => 'yii\rest\UrlRule',
           	    'controller' => ['detail'],
       		    ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '124.200.176.198'],
    ];
}

return $config;
