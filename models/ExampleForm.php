<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Example;
use yii\helpers\Json;
use yii\helpers\Html;

/****************************************************
body post
*****************************************************
*[
*    {
*        "name" : "Muri Budiman",
*        "email" : "udamuri@gmail.com",
*        "blog" : "muribudiman.wordpress.com",
*        "company" : "Mindo",
*        "bio" : "Lorem Ipsum Dolor SIt Amet"
*    },
*    {
*        "name" : "Heru Budiman",
*        "email" : "udaheru@gmail.com",
*        "blog" : "herubudiman.wordpress.com",
*        "company" : "Mindo",
*        "bio" : "Lorem Ipsum Dolor SIt Amet"
*    }
*]
****************************************************/
class ExampleForm extends Model
{

    /******************************
    * Example Create to table example
    ******************************/
    public function create($json="")
    {
        $arrMessage = [];
        $error = true;
        if(is_array($json))
        {
            $arrErr = [];
            foreach ($json as $key => $value) {
                if(isset($value['name']) && isset($value['email']) )
                {
                    $valid = $this->EmailValid($value['email']);
                    if(count($valid) == 0 )
                    {
                        $create = new Example();
                        $create->name = Html::encode($value['name']);
                        $create->email = Html::encode($value['email']);
                        if( isset($value['blog']) )
                        {
                            $create->blog = Html::encode($value['blog']);
                        }
                        if( isset($value['company']) )
                        {
                            $create->company = Html::encode($value['company']);
                        }
                        if( isset($value['bio']) )
                        {
                             $create->bio = Html::encode($value['bio']);   
                        }
                        if($create->save(false))
                        {
                            $error = false;
                            $arrErr[] = [
                                'id' => $create->id,
                                'message' => 'success'
                            ];
                        }
                        else
                        {
                            $error = true;
                            $arrErr[] = [
                                'id' => $key,
                                'message' => 'unsuccessful'
                            ];  
                        }
                    }
                    else
                    {
                        $error = true;
                        $arrErr[] = [
                            'id' => $key,
                            'message' => 'Duplicate entry '.$value['email'].' for key \'email'
                        ];    
                    }
                }
                else
                {
                    $error = true;
                    $arrErr[] = [
                        'id' => $key,
                        'message' => 'name OR email not defined'
                    ];   
                }
            }

            $arrMessage = [
                'error' => $error,
                'message' => $arrErr,
            ];

            return $arrMessage;
        }

        $arrMessage = [
            'error' => $error,
            'message' => 'The data read from a file wasn\'t in the expected format.',
        ];

        return $arrMessage;
    }

    /******************************
    * Example Get data from table example
    ******************************/
    public function getExample()
    {
        $rows = (new \yii\db\Query())
            ->select(['id', 'name', 'email', 'blog', 'company', 'bio'])
            ->from('example')
            //->where(['last_name' => 'Smith'])
            ->limit(10)
            ->all();

        $arrData = [
            'status'=>'true',
            'count' => count($rows),
            'data' => $rows
        ];
        return $arrData;
    }
	
    public function delete($id)
    {

        $delete = Employee::findOne($id);
        if($delete)
        {
            return $delete->delete();
        }

        return null;  
    }
	
    private function EmailValid($email = "")
    {
        $model = Example::find()->where(['email'=>$email])->one();
        return $model;
    }
}