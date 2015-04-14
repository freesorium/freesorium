<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $site_id
 * @property string $title
 * @property string $content
 * @property integer $rating
 * @property string $create_date
 * @property string $publish_date
 * @property string $expire_date
 * @property string $update_date
 * @property integer $is_hidden
 * @property integer $is_deleted
 * @property integer $is_anonymous
 * @property integer $is_protected
 *
 * @property Comment[] $comments
 * @property IgnorePost[] $ignorePosts
 * @property User $user
 * @property Site $site
 * @property PostVote[] $postVotes
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'content', 'create_date', 'publish_date'], 'required'],
            [['user_id', 'site_id', 'rating', 'is_hidden', 'is_deleted', 'is_anonymous', 'is_protected'], 'integer'],
            [['content'], 'string'],
            [['create_date', 'publish_date', 'expire_date', 'update_date'], 'safe'],
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
            'site_id' => Yii::t('app', 'Сайт'),
            'title' => Yii::t('app', 'Заголовок'),
            'content' => Yii::t('app', 'Текст'),
            'rating' => Yii::t('app', 'Рейтинг'),
            'create_date' => Yii::t('app', 'Дата создания'),
            'publish_date' => Yii::t('app', 'Дата публикации'),
            'expire_date' => Yii::t('app', 'Дата снятия с публикации'),
            'update_date' => Yii::t('app', 'Дата изменения'),
            'is_hidden' => Yii::t('app', 'Скрыт'),
            'is_deleted' => Yii::t('app', 'Удален'),
            'is_anonymous' => Yii::t('app', 'Анонимный'),
            'is_protected' => Yii::t('app', 'Защищенный'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIgnorePosts()
    {
        return $this->hasMany(IgnorePost::className(), ['post_id' => 'id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostVotes()
    {
        return $this->hasMany(PostVote::className(), ['post_id' => 'id']);
    }
}
