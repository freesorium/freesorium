<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "replace".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $site_id
 * @property string $search
 * @property string $replace
 * @property integer $count
 * @property string $start_date
 * @property string $end_date
 * @property integer $is_active
 *
 * @property User $user
 * @property Site $site
 */
class Replace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'replace';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'site_id', 'search', 'replace', 'start_date', 'end_date'], 'required'],
            [['user_id', 'site_id', 'count', 'is_active'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['search', 'replace'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ИД'),
            'user_id' => Yii::t('app', 'Автор'),
            'site_id' => Yii::t('app', 'Сайт'),
            'search' => Yii::t('app', 'Слово'),
            'replace' => Yii::t('app', 'Замена'),
            'count' => Yii::t('app', 'Количество замен'),
            'start_date' => Yii::t('app', 'Дата начала'),
            'end_date' => Yii::t('app', 'Дата завершения'),
            'is_active' => Yii::t('app', 'Активная замена'),
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
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'site_id']);
    }
}
