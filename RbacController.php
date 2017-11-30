<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use Yii;
use app\models\RuleAuthor;

class RbacController extends Controller
{
    public function actionTest1(){
        $auth = Yii::$app->authManager;
	$createPost = $auth->createPermission('createPost');
	$createPost->description = "create a post";
	$auth->add($createPost);
    }

    public function actionTest2(){
	$auth = Yii::$app->authManager;
	$updatePost = $auth->createPermission('updatePost');
	$updatePost->description = "update a post";
	$auth->add($updatePost);
    }

    public function actionTest3(){
	$auth = Yii::$app->authManager;
	$author = $auth->createRole("author");
	$createPost = $auth->createPermission('createPost');
	$auth->add($author);
	$auth->addChild($author, $createPost);
    }

    public function actionTest4(){
	$auth = Yii::$app->authManager;
	$admin = $auth->createRole('admin');
        $auth->add($admin);
	$author = $auth->createRole("author");
	$updatePost = $auth->createPermission('updatePost');
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);
    }

    public function actionTest5(){
	$auth = Yii::$app->authManager;
	$author = $auth->getRole("author");
	$admin = $auth->getRole('admin');
	$auth->assign($author, 2);
	$auth->assign($admin, 1);
    }

    public function actionTest6(){
	$params = '';
	$accessChecker = Yii::$app->authManager;
	$access = $accessChecker->checkAccess('2', 'createPost', $params);
	var_dump($access);
    }

    public function actionTest7(){
	$auth = Yii::$app->authManager;
	$rule = new RuleAuthor();
	$auth->add($rule);
	$updatePost = $auth->getPermission('updatePost');
	$updateOwnPost = $auth->createPermission('updateOwnPost');
	$updateOwnPost->description = "update own post";
	$updateOwnPost->ruleName = $rule->name;
	$auth->add($updateOwnPost);
	$author = $auth->getRole("author");
	$auth->addChild($updateOwnPost, $updatePost);
	$auth->addChild($author, $updateOwnPost);
    }

    public function actionTest8(){
	$params = '';
        $accessChecker = Yii::$app->authManager;
        $access = $accessChecker->checkAccess('2', 'updateOwnPost', $params);
        var_dump($access);
    }
 
    public function actionTest9(){
	$params = '';
	$auth = Yii::$app->authManager;
	$rule = $auth->getRule('isAuthor');
	$res = $rule->execute('2', 'updateOwnPost', $params);
	var_dump($res);
    }

    public function actionTest10(){
	$auth = Yii::$app->authManager;
	$rule = new RuleAuthor();
	$auth->updateRule('isAuthor', $rule);
    }
}

