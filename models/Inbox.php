<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inbox".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property integer $count
 * @property string $create_date
 * @property string $update_date
 *
 * @property User $user
 * @property InboxMessage[] $inboxMessages
 * @property InboxUser[] $inboxUsers
 */
class Inbox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inbox';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'create_date'], 'required'],
            [['user_id', 'count'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
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
            'user_id' => Yii::t('app', 'Автор'),
            'title' => Yii::t('app', 'Заголовок'),
            'count' => Yii::t('app', 'Количество сообщений'),
            'create_date' => Yii::t('app', 'Дата создания'),
            'update_date' => Yii::t('app', 'Дата изменения'),
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
    public function getInboxMessages()
    {
        return $this->hasMany(InboxMessage::className(), ['inbox_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInboxUsers()
    {
        return $this->hasMany(InboxUser::className(), ['inbox_id' => 'id']);
    }
}
