<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inbox_message".
 *
 * @property integer $id
 * @property integer $inbox_id
 * @property integer $user_id
 * @property string $content
 * @property string $create_date
 * @property string $update_date
 * @property integer $is_active
 *
 * @property Inbox $inbox
 * @property User $user
 */
class InboxMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inbox_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inbox_id', 'user_id', 'content', 'create_date'], 'required'],
            [['inbox_id', 'user_id', 'is_active'], 'integer'],
            [['content'], 'string'],
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
            'inbox_id' => Yii::t('app', 'Инбокс'),
            'user_id' => Yii::t('app', 'Автор'),
            'content' => Yii::t('app', 'Текст'),
            'create_date' => Yii::t('app', 'Дата создания'),
            'update_date' => Yii::t('app', 'Дата обновления'),
            'is_active' => Yii::t('app', 'Активное сообщение'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInbox()
    {
        return $this->hasOne(Inbox::className(), ['id' => 'inbox_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
