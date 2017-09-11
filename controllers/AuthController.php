<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\filters\ContentNegotiator;
use yii\filters\auth\HttpBasicAuth;
use yii\web\Request;
use yii\web\Response;
use yii\helpers\Json;
use app\models\User;

class AuthController extends Controller
{
   	public function behaviors(){
      $behaviors = parent::behaviors();
      $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                // restrict access to
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['POST', 'GET'],
                // Allow only POST and PUT methods
                'Access-Control-Request-Headers' => [' X-Requested-With'],
                // Allow only headers 'X-Wsse'
                'Access-Control-Allow-Credentials' => true,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],

      ];

      $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'login' => ['post'],
            ],
      ];
          
      return $behaviors;


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
    public function actionLogin()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $response = ['token'=>'1234567890'];
        $email = isset($_POST['email'])?$_POST['email']:'empty';
        echo $email;
        return $response; 
    }

}
