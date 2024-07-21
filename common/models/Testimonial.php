<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "testimonial".
 *
 * @property int $id
 * @property string $user_name
 * @property string|null $user_role
 * @property string $description
 * @property string|null $avatar
 * @property string $created_at
 */
class Testimonial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testimonial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'description'], 'required'],
            [['created_at'], 'safe'],
            [['user_name', 'user_role'], 'string', 'max' => 100],
            [['description', 'avatar'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_name' => Yii::t('app', 'User Name'),
            'user_role' => Yii::t('app', 'User Role'),
            'description' => Yii::t('app', 'Description'),
            'avatar' => Yii::t('app', 'Avatar'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
