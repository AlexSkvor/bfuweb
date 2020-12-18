<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calls".
 *
 * @property string $id
 * @property string $managerId
 * @property string $clientId
 * @property int $status
 * @property string $beginTime
 * @property string|null $updated_at
 * @property string $created_at
 *
 * @property Clients $client
 * @property Managers $manager
 */
class Calls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'managerId', 'clientId', 'status'], 'required'],
            [['status'], 'integer'],
            [['beginTime', 'updated_at', 'created_at'], 'safe'],
            [['id', 'managerId', 'clientId'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['clientId'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['clientId' => 'id']],
            [['managerId'], 'exist', 'skipOnError' => true, 'targetClass' => Managers::className(), 'targetAttribute' => ['managerId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'managerId' => 'Manager ID',
            'clientId' => 'Client ID',
            'status' => 'Status',
            'beginTime' => 'Begin Time',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'clientId']);
    }

    /**
     * Gets query for [[Manager]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Managers::className(), ['id' => 'managerId']);
    }
}
