<?php

namespace app\controllers\actions\activity;

use yii\base\Action;
use app\components\ActivityComponent;
use yii\web\HttpException;

class ActivityEditAction extends Action {


    public function run($id) {

        /** @var ActivityComponent  $comp */

        $comp = \Yii::createObject(['class'=>ActivityComponent::class,'model'=>'app\models\Activity']);
        $model = $comp->getActivityById($id);
    
        if(\Yii::$app->request->isPost) {
    
            $model->load(\Yii::$app->request->post());
    
            if($comp->editActivity($model)) {
    
                return $this->controller->redirect(['day/','date'=>$model->dateStart]);
            }
        }

        if(!\Yii::$app->rbac->canViewOrEditActivity($model)) {
            throw new HttpException(403,'Недостаточно прав!');
        }
        return $this->controller->render('update', ['model'=>$model]); 
    }
}