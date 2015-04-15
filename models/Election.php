<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "election".
 *
 * @property integer $id
 * @property integer $site_id
 * @property string $start_date
 * @property string $end_date
 * @property string $update_date
 * @property integer $is_active
 *
 * @property Site $site
 * @property ElectionUser[] $electionUsers
 * @property ElectionVote[] $electionVotes
 */
class Election extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'election';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'is_active'], 'integer'],
            [['start_date', 'end_date'], 'required'],
            [['start_date', 'end_date', 'update_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ИД'),
            'site_id' => Yii::t('app', 'Сайт'),
            'start_date' => Yii::t('app', 'Дата начала'),
            'end_date' => Yii::t('app', 'Дата завершения'),
            'update_date' => Yii::t('app', 'Дата обновления'),
            'is_active' => Yii::t('app', 'Активное голосование'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'site_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElectionUsers()
    {
        return $this->hasMany(ElectionUser::className(), ['election_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElectionVotes()
    {
        return $this->hasMany(ElectionVote::className(), ['election_id' => 'id']);
    }
}
