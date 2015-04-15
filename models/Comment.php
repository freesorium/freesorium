<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $post_id
 * @property string $content
 * @property integer $rating
 * @property string $create_date
 * @property string $update_date
 * @property integer $is_deleted
 * @property integer $tree
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 *
 * @property User $user
 * @property Post $post
 * @property CommentVote[] $commentVotes
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id', 'content', 'create_date', 'lft', 'rgt', 'depth'], 'required'],
            [['user_id', 'post_id', 'rating', 'is_deleted', 'tree', 'lft', 'rgt', 'depth'], 'integer'],
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
            'user_id' => Yii::t('app', 'Автор'),
            'post_id' => Yii::t('app', 'Пост'),
            'content' => Yii::t('app', 'Комментарий'),
            'rating' => Yii::t('app', 'Рейтинг'),
            'create_date' => Yii::t('app', 'Дата создания'),
            'update_date' => Yii::t('app', 'Дата изменения'),
            'is_deleted' => Yii::t('app', 'Удален'),
            'tree' => Yii::t('app', 'Tree'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'depth' => Yii::t('app', 'Depth'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentVotes()
    {
        return $this->hasMany(CommentVote::className(), ['comment_id' => 'id']);
    }
}
