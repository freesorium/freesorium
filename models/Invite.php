<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invite".
 *
 * @property integer $id
 * @property string $code
 * @property integer $father_id
 * @property integer $child_id
 * @property string $create_date
 * @property string $expire_date
 * @property string $use_date
 * @property integer $is_active
 *
 * @property User $father
 */
class Invite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'father_id', 'create_date', 'use_date'], 'required'],
            [['father_id', 'child_id', 'is_active'], 'integer'],
            [['create_date', 'expire_date', 'use_date'], 'safe'],
            [['code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ИД'),
            'code' => Yii::t('app', 'Код приглашения'),
            'father_id' => Yii::t('app', 'Отправитель'),
            'child_id' => Yii::t('app', 'Получатель'),
            'create_date' => Yii::t('app', 'Дата создания'),
            'expire_date' => Yii::t('app', 'Дата истечения'),
            'use_date' => Yii::t('app', 'Дата использования'),
            'is_active' => Yii::t('app', 'Активный инвайт'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFather()
    {
        return $this->hasOne(User::className(), ['id' => 'father_id']);
    }
}
