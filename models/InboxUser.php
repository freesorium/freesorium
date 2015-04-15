<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inbox_user".
 *
 * @property integer $id
 * @property integer $inbox_id
 * @property integer $user_id
 * @property string $join_date
 * @property string $expire_date
 * @property string $last_read_date
 * @property integer $is_active
 *
 * @property Inbox $inbox
 * @property User $user
 */
class InboxUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inbox_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inbox_id', 'user_id', 'join_date', 'expire_date', 'last_read_date'], 'required'],
            [['inbox_id', 'user_id', 'is_active'], 'integer'],
            [['join_date', 'expire_date', 'last_read_date'], 'safe']
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
            'user_id' => Yii::t('app', 'Пользователь'),
            'join_date' => Yii::t('app', 'Дата входа'),
            'expire_date' => Yii::t('app', 'Дата выхода'),
            'last_read_date' => Yii::t('app', 'Дата последнего прочтения'),
            'is_active' => Yii::t('app', 'Активный'),
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
