<?php
namespace app\models;


use app\models\validations\DateCompareValidation;
use app\behaviors\ShowLogBehavior;

class Activity extends ActivitiesBase {
    
    public $email;
    public $userFiles;
    
    public const REPEAT_TYPE=['1d'=>'каждый день','1w'=>'каждую неделю', '1m'=>'каждый месяц']; 

    public function behaviors()
    {
        return [
            // [
            //     'class'=> app\behaviors\GetDateCreateBehavior::class,
            //     'attribute_name'=>'created_at'
            // ],
            // ShowLogBehavior::class

        ];
    }


    public function beforeValidate()
    {
        if($this->dateStart){
            if($date = \DateTime::createFromFormat('Y-m-d',$this->dateStart)) {
                $this->dateStart = $date->format('Y-m-d');
            }
        }

        if($this->dateFinish){
            if($date = \DateTime::createFromFormat('Y-m-d',$this->dateFinish)) {
                $this->dateFinish = $date->format('Y-m-d');
            }
        }
        return parent::beforeValidate();
    }

    public function rules(){
        return array_merge([
            ['title','string','min'=>5, 'max'=>255],
            ['title','trim'],
            ['dateStart','required'],
            ['dateStart', 'default','value'=> date('Y-m-d')],
            ['dateStart','date','format'=>'php:Y-m-d'],
            ['timeStart','time','format'=>'php: G:i'],
            ['timeStart','required'],
            ['dateFinish','required'],
            ['dateFinish','default','value'=>date('d:m:Y')],
            ['dateFinish','date','format'=>'php:Y-m-d'],
            ['timeFinish','time','format'=>'php: G:i'],
            ['timeFinish','required'],
            [['dateStart','dateFinish','timeStart','timeFinish'],DateCompareValidation::class],
            [['dateStart','dateFinish'],DateCompareValidation::class],
            ['title','required'],
            [['useNotification','isBlocked'],'boolean'],
            ['description','string', 'max'=>255],
            ['description','trim'],
            ['email','email'],
            ['email','required','when'=>function($model){
                return $model->useNotification;
            }],
            [['userFiles'],'file','extensions'=>['jpg','png'],'maxFiles'=>3],
            ['repeatType','in','range'=>array_keys(self::REPEAT_TYPE)]
        ],parent::rules());
    }
    public function attributeLabels()
    {
        return [
            'title'=>'Заголовок события',
            'description'=>'Описание',
            'isBlocked'=>'Блокирующее',
            'dateStart'=>'Дата начала',
            'dateFinish'=>'Дата окончания',
            'isRepeat'=>'Повторяющиеся',
            'repeatType'=>'Тип повторения',
            'useNotification'=>'Уведомлять?'
        ];
    }
}