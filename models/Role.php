<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $is_active
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['is_active'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ИД'),
            'code' => Yii::t('app', 'Код'),
            'name' => Yii::t('app', 'Наименование'),
            'is_active' => Yii::t('app', 'Активная роль'),
        ];
    }
}
