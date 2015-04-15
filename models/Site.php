<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "site".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $code
 * @property string $name
 * @property string $create_date
 * @property string $publish_date
 * @property string $expire_date
 * @property string $update_date
 * @property integer $is_hidden
 * @property integer $is_deleted
 * @property integer $is_protected
 *
 * @property Election[] $elections
 * @property Post[] $posts
 * @property Replace[] $replaces
 * @property User $user
 * @property UserRole[] $userRoles
 */
class Site extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'code', 'name', 'create_date'], 'required'],
            [['user_id', 'is_hidden', 'is_deleted', 'is_protected'], 'integer'],
            [['create_date', 'publish_date', 'expire_date', 'update_date'], 'safe'],
            [['code', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ИД'),
            'user_id' => Yii::t('app', 'Создатель'),
            'code' => Yii::t('app', 'Код'),
            'name' => Yii::t('app', 'Название'),
            'create_date' => Yii::t('app', 'Дата создания'),
            'publish_date' => Yii::t('app', 'Дата публикации'),
            'expire_date' => Yii::t('app', 'Дата снятия с публикации'),
            'update_date' => Yii::t('app', 'Дата обновления'),
            'is_hidden' => Yii::t('app', 'Скрыт'),
            'is_deleted' => Yii::t('app', 'Удален'),
            'is_protected' => Yii::t('app', 'Защищен'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElections()
    {
        return $this->hasMany(Election::className(), ['site_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['site_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReplaces()
    {
        return $this->hasMany(Replace::className(), ['site_id' => 'id']);
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
    public function getUserRoles()
    {
        return $this->hasMany(UserRole::className(), ['site_id' => 'id']);
    }
}
