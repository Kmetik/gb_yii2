<?php 

namespace app\controllers\actions\activity;

use yii\base\Action;
use app\components\ActivityComponent;
use yii\web\HttpException;

class ActivityIndexAction extends Action {
    
    
    public function run($id) {
       
        $comp = \Yii::createObject(['class'=>ActivityComponent::class,'model'=>'app\models\Activity']);

        $model = $comp->getActivityById($id);
        
        if(!\Yii::$app->rbac->canViewOrEditActivity($model)) {
            throw new HttpException(403,'Не хватает прав доступа');
        }
        
        return $this->controller->render('index',['model'=>$model]);
        
    }
}