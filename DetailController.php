<?php
    namespace app\controllers;

    use yii\rest\ActiveController;
    use yii\web\Response;

    class DetailController extends ActiveController
    {
        public $modelClass = 'app\models\Detail';
        //默认xml格式，加入下面的behaviors生成json格式
        public function behaviors()
        {
            $behaviors = parent::behaviors();
            $behaviors['contentNegotiator']['formats'] = ['application/json' => Response::FORMAT_JSON];

            return $behaviors;
        }
    }
