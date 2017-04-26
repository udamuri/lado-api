<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Employee;
use yii\helpers\Json;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $birthday
 * @property string $photo
 * @property integer $created_at
 * @property integer $updated_at
 */

class ExampleForm extends Model
{
	
    public $id;
    public $name;
    public $email;
    public $photo;
    public $supplier_phone2;
    public $supplier_status;
    public $created_at;
    public $updated_at;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['name', 'required'],
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'string', 'max' => 150],
        ];
    }

    public function create()
    {
        return null;
    }

    public function getExample()
    {
        $rows = (new \yii\db\Query())
            ->select(['id', 'name', 'email', 'birthday', 'photo'])
            ->from('employee')
            //->where(['last_name' => 'Smith'])
            ->limit(10)
            ->all();
        $arrData = [
            'status'=>'true',
            'data' => $rows
        ];
        return $arrData;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function update($id)
    {
        return null;
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
	
}
