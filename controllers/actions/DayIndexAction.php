<?php
namespace app\controllers\actions;

use yii\base\Action;
use app\components\ActivityComponent;

class DayIndexAction extends Action {


    public function run($date){
        
        $comp = \Yii::createObject(['class'=>ActivityComponent::class,'model'=>'app\models\Day']);
        $userActivities = $comp->getActivityByDate($date);
        
        return $this->controller->render('index',['activities'=>$userActivities]);
    }
}