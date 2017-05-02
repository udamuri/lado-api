<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\filters\ContentNegotiator;
use yii\filters\auth\QueryParamAuth;
use yii\filters\Cors;
use yii\web\Request;
use yii\web\Response;
use yii\helpers\Json;
use app\models\User;
use app\models\ExampleForm;


class MokenController extends Controller
{
   	public function behaviors(){
      $behaviors = parent::behaviors();
      $behaviors['corsFilter'] = [
          'class' => Cors::className(),
          'cors' => [
            'Origin' => ['*'],
        ],
      ];

      return $behaviors;
    }

    protected function verbs()
    {
       return [
           'index' => ['GET'],
           'create' => ['POST'],
       ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new ExampleForm();
        $data = $model->getExample();
        return $data;
    }

    public function actionCreate()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->getIsPost())
        {
          $post = Yii::$app->request->post();
          $model = new ExampleForm();
          $create = $model->create($post);
          return $create;
        }

        return null;
    }

}
