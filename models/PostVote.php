<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_vote".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $post_id
 * @property integer $rating
 * @property string $create_date
 * @property string $update_date
 * @property integer $is_active
 *
 * @property User $user
 * @property Post $post
 */
class PostVote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_vote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id', 'rating', 'create_date'], 'required'],
            [['user_id', 'post_id', 'rating', 'is_active'], 'integer'],
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
            'user_id' => Yii::t('app', 'Пользователь'),
            'post_id' => Yii::t('app', 'Пост'),
            'rating' => Yii::t('app', 'Изменение рейтинга'),
            'create_date' => Yii::t('app', 'Дата создания'),
            'update_date' => Yii::t('app', 'Дата изменения'),
            'is_active' => Yii::t('app', 'Активный голос'),
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
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
