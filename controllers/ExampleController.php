<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\filters\ContentNegotiator;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\web\Request;
use yii\web\Response;
use yii\helpers\Json;
use app\models\User;
use app\models\ExampleForm;


class ExampleController extends Controller
{
   	public function behaviors(){
      return [
          'basicAuth' => [
              'class' => \yii\filters\auth\HttpBasicAuth::className(),
              'auth' => function ($username, $password) {
                  $user = User::find()->where(['username' => $username])->one();
                  if ($user) {
                      if($user->validatePassword($password))
                      {
                        return $user;
                      }
                  }
                  return null;
              },
          ],
      ];
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
