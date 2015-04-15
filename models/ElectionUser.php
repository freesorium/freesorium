<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "election_user".
 *
 * @property integer $id
 * @property integer $election_id
 * @property integer $user_id
 * @property integer $count
 *
 * @property Election $election
 * @property User $user
 */
class ElectionUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'election_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['election_id', 'user_id'], 'required'],
            [['election_id', 'user_id', 'count'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ИД'),
            'election_id' => Yii::t('app', 'Выборы'),
            'user_id' => Yii::t('app', 'Пользователь'),
            'count' => Yii::t('app', 'Количество голосов'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElection()
    {
        return $this->hasOne(Election::className(), ['id' => 'election_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
