<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property string $id
 * @property string $fullName
 * @property string $password_hash
 * @property string $phone
 * @property string $login
 * @property string|null $updated_at
 * @property string $created_at
 *
 * @property Calls[] $calls
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fullName', 'password_hash', 'phone', 'login'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['id', 'fullName', 'password_hash', 'phone', 'login'], 'string', 'max' => 255],
            [['phone'], 'unique'],
            [['login'], 'unique'],
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
            'fullName' => 'Full Name',
            'password_hash' => 'Password Hash',
            'phone' => 'Phone',
            'login' => 'Login',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Calls]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCalls()
    {
        return $this->hasMany(Calls::className(), ['clientId' => 'id']);
    }
}
