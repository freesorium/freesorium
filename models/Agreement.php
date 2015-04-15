<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agreement".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $create_date
 * @property string $start_date
 * @property string $end_date
 * @property integer $is_active
 *
 * @property UserAgreement[] $userAgreements
 */
class Agreement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agreement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'create_date', 'start_date', 'end_date'], 'required'],
            [['text'], 'string'],
            [['create_date', 'start_date', 'end_date'], 'safe'],
            [['is_active'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ИД'),
            'title' => Yii::t('app', 'Заголовок'),
            'text' => Yii::t('app', 'Текст'),
            'create_date' => Yii::t('app', 'Дата создания'),
            'start_date' => Yii::t('app', 'Дата начала'),
            'end_date' => Yii::t('app', 'Дата завершения'),
            'is_active' => Yii::t('app', 'Флаг активности'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAgreements()
    {
        return $this->hasMany(UserAgreement::className(), ['agreement_id' => 'id']);
    }
}
