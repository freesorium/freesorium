<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favorite_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property UserFavorite[] $userFavorites
 */
class FavoriteType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favorite_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ИД'),
            'name' => Yii::t('app', 'Наименование'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFavorites()
    {
        return $this->hasMany(UserFavorite::className(), ['favorite_type_id' => 'id']);
    }
}
