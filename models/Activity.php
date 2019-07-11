<?php
namespace app\models;


use app\models\validations\DateCompareValidation;
use app\behaviors\ShowLogBehavior;
use app\models\validations\RepeatValidation;

class Activity extends ActivitiesBase {
    
    public $userFiles;
    public $updateRelations;

    const  SCENARIO_EDITREPEATED = 'edit_repeated';
    
    public const REPEAT_TYPE=['1 day'=>'каждый день','1 week'=>'каждую неделю' ,'2 weeks'=>'каждые 2 недели',  '1 month'=>'каждый месяц']; 
    public const NOTIFICATION_TYPE=['1 hour'=>'за час','1 day'=>'за день','10 minutes'=>'за десять минут'];

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
        // if($this->dateStart){
        //     if($date = \DateTime::createFromFormat('Y-m-d',$this->dateStart)) {
        //         $this->dateStart = $date->format('Y-m-d');
        //     }
        // }

        // if($this->dateFinish){
        //     if($date = \DateTime::createFromFormat('Y-m-d',$this->dateFinish)) {
        //         $this->dateFinish = $date->format('Y-m-d');
        //     }
        // }
        
        $this->timeStart = \Yii::$app->formatter->asTime($this->timeStart,'php: H:i');
        $this->timeFinish = \Yii::$app->formatter->asTime($this->timeFinish,'php: H:i');
        
        return parent::beforeValidate();
    }

    public function setScenarioEditRepeated()
    {
        $this->setScenario(self::SCENARIO_EDITREPEATED);
        return $this;
    }

    public function rules(){
        return array_merge([
            ['title','string','min'=>5, 'max'=>255],
            ['title','trim'],
            ['dateStart','required'],
            ['dateStart','date','format'=>'php:Y-m-d'],
            ['timeStart','time','format'=>'php: H:i'],
            ['timeStart','required'],
            ['dateFinish','required'],
            ['dateFinish','date','format'=>'php:Y-m-d'],
            ['timeFinish','time','format'=>'php: H:i'],
            ['timeFinish','required'],
            [['dateStart','dateFinish','timeStart','timeFinish'],DateCompareValidation::class],
            [['dateStart','dateFinish'],DateCompareValidation::class],
            ['title','required'],
            [['useNotification','isBlocked','isRepeat'],'boolean'],
            ['description','string', 'max'=>255],
            ['description','trim'],
            ['repeatEnd', RepeatValidation::class],
            [['userFiles'],'file','extensions'=>['jpg','png'],'maxFiles'=>3],
            ['repeatType','in','range'=>array_keys(self::REPEAT_TYPE)],
            ['updateRelations','boolean']
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
            'useNotification'=>'Уведомлять?',
            'updateRelations'=>'Все в последовательности?',
            'active'=>'Активно?'

        ];
    }

    public function getRelated() {
        return self::find(['id'=>$this->relatesToId])->cache(10)->all();
    }
}