<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "example".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $blog
 * @property string $company
 * @property string $bio
 */
class Example extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'example';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['name', 'blog', 'company'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 32],
            [['bio'], 'string', 'max' => 255],
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
            'blog' => 'Blog',
            'company' => 'Company',
            'bio' => 'Bio',
        ];
    }
}
