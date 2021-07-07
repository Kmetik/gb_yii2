<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activities".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $dateStart
 * @property string $timeStart
 * @property string $dateFinish
 * @property string $timeFinish
 * @property int $isBlocked
 * @property int $isRepeat
 * @property int $useNotification
 * @property string $repeatType
 * @property int $userFiles
 * @property int $active
 * @property string $created_at
 *
 * @property Users $user
 * @property UserFiles[] $userFiles0
 */
class ActivitiesBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'dateStart', 'timeStart', 'dateFinish'], 'required'],
            [['user_id', 'isBlocked', 'isRepeat', 'useNotification', 'active'], 'integer'],
            [['description'], 'string'],
            [['dateStart', 'timeStart', 'dateFinish', 'timeFinish', 'created_at'], 'safe'],
            [['title'], 'string', 'max' => 150],
            [['repeatType'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'dateStart' => Yii::t('app', 'Date Start'),
            'timeStart' => Yii::t('app', 'Time Start'),
            'dateFinish' => Yii::t('app', 'Date Finish'),
            'timeFinish' => Yii::t('app', 'Time Finish'),
            'isBlocked' => Yii::t('app', 'Is Blocked'),
            'isRepeat' => Yii::t('app', 'Is Repeat'),
            'useNotification' => Yii::t('app', 'Use Notification'),
            'repeatType' => Yii::t('app', 'Repeat Type'),
            'userFiles' => Yii::t('app', 'User Files'),
            'active' => Yii::t('app', 'Active'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFiles0()
    {
        return $this->hasMany(UserFiles::className(), ['activity_id' => 'id']);
    }
}
