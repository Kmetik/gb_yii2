<?php

namespace app\controllers\actions\activity;

use yii\base\Action;
use app\components\ActivityComponent;
use yii\web\HttpException;

class ActivityEditAction extends Action {


    public function run($id) {

        /** @var ActivityComponent  $comp */

        $comp = \Yii::createObject(['class'=>ActivityComponent::class,'model'=>'app\models\Activity']);
        if(!$model = $comp->getActivityById($id)){
            throw new HttpException(404,'Нет таких');
        }
    
        if(!\Yii::$app->rbac->canViewOrEditActivity($model)) {
            throw new HttpException(403,'Недостаточно прав!');
        }
        
        if(\Yii::$app->request->isPost) {
    
            $model->load(\Yii::$app->request->post());
    
            
            if($comp->editActivity($model)) {
    
                return $this->controller->redirect(['day/','date'=>$model->dateStart]);
            }
        }

        
        return $this->controller->render('update', ['model'=>$model]); 
    }
}