<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_agreement".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $agreement_id
 * @property string $create_date
 *
 * @property User $user
 * @property Agreement $agreement
 */
class UserAgreement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_agreement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'agreement_id', 'create_date'], 'required'],
            [['user_id', 'agreement_id'], 'integer'],
            [['create_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ИД'),
            'user_id' => Yii::t('app', 'Пользователь'),
            'agreement_id' => Yii::t('app', 'Соглашение'),
            'create_date' => Yii::t('app', 'Дата создания'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgreement()
    {
        return $this->hasOne(Agreement::className(), ['id' => 'agreement_id']);
    }
}
