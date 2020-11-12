<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "managers".
 *
 * @property string $id
 * @property string $fullName
 * @property string $password_hash
 * @property string $email
 * @property string $phone
 * @property string $login
 * @property int $status
 * @property string|null $updated_at
 * @property string $created_at
 *
 * @property Call[] $calls
 */
class Managers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'managers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fullName', 'password_hash', 'email', 'phone', 'login'], 'required'],
            [['status'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['id', 'fullName', 'password_hash', 'email', 'phone', 'login'], 'string', 'max' => 255],
            [['email'], 'unique'],
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
            'email' => 'Email',
            'phone' => 'Phone',
            'login' => 'Login',
            'status' => 'Status',
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
        return $this->hasMany(Call::className(), ['managerId' => 'id']);
    }
}
