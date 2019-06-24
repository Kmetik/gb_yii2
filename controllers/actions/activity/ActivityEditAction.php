<?php

namespace app\controllers\actions\activity;

use yii\base\Action;
use app\components\ActivityComponent;
use yii\web\HttpException;

class ActivityEditAction extends Action {

    public function run($id) {
        $comp = \Yii::createObject(['class'=>ActivityComponent::class,'model'=>'app\models\Activity']);
        $model = $comp->editActivity($id);
        
        if(!\Yii::$app->rbac->canViewOrEditActivity($model)) {
            throw new HttpException(403,'Недостаточно прав!');
        } 
        return $this->controller->render('create', ['model'=>$model]); 
    }
}