<?php
namespace app\models;

use yii\base\Model;

class Activity extends Model{
    public $title;
    public $description;
    public $dateStart;
    public $dateFinish;
    public $isBlocked;
    public $isRepeat;
    
    public function rules(){
        return [
            ['title','string','min'=>5],
            ['title','required'],
            ['isBlocked','boolean'],
            ['description','string']
        ];
    }
    public function attributeLabels()
    {
        return [
            'title'=>'Заголовок события',
            'description'=>'Описание',
            'isBlocked'=>'Блокирующее'
        ];
    }
}