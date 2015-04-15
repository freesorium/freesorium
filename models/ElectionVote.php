<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "election_vote".
 *
 * @property integer $id
 * @property integer $election_id
 * @property integer $voter_id
 * @property integer $user_id
 * @property string $create_date
 * @property string $update_date
 * @property integer $is_active
 *
 * @property Election $election
 * @property User $user
 */
class ElectionVote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'election_vote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['election_id', 'voter_id', 'user_id', 'create_date'], 'required'],
            [['election_id', 'voter_id', 'user_id', 'is_active'], 'integer'],
            [['create_date', 'update_date'], 'safe']
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
            'voter_id' => Yii::t('app', 'Автор голоса'),
            'user_id' => Yii::t('app', 'Кому голос'),
            'create_date' => Yii::t('app', 'Дата создания'),
            'update_date' => Yii::t('app', 'Дата обновления'),
            'is_active' => Yii::t('app', 'Активный голос'),
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
