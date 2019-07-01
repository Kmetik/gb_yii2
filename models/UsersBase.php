<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password_hash
 * @property int $role
 * @property string $auth_token
 * @property string $auth_key
 * @property string $created_at
 *
 * @property Activities[] $activities
 */
class UsersBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password_hash'], 'required'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 55],
            [['password_hash'], 'string', 'max' => 255],
            [['auth_token', 'auth_key'], 'string', 'max' => 300]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'role' => Yii::t('app', 'Role'),
            'auth_token' => Yii::t('app', 'Auth Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activities::className(), ['user_id' => 'id']);
    }
}
