<?php

namespace app\models;

use Yii;

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
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'email'], 'required'],
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['birthday'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['photo'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'birthday' => 'Birthday',
            'photo' => 'Photo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
