<?php
namespace app\controllers\actions;

use yii\base\Action;
use app\components\DayComponent;

class DayIndexAction extends Action {
    public function run(){
        $comp = \Yii::createObject(['class'=>DayComponent::class,'model'=>'app\models\Day']);
        $model = $comp->getModel();
        if(\Yii::$app->request->isGet){
            $model->date = \Yii::$app->request->get('date');
            $userActivities = $comp->getActivities($model);
        } 
        return $this->controller->render('index',['activities'=>$userActivities]);
    }
}