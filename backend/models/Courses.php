<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property string $id
 * @property string $name
 * @property string $url
 * @property int $price
 * @property string|null $updated_at
 * @property string $created_at
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'url', 'price'], 'required'],
            [['price'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['id', 'name', 'url'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'price' => 'Price',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
