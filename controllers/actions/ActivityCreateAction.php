<?php
namespace app\controllers\actions;

use yii\base\Action;
use app\models\Activity;
use app\components\ActivityComponent;

class ActivityCreateAction extends Action {
    public $name;
    public function run(){
        $comp = \Yii::createObject(['class'=>ActivityComponent::class, 'modelClass'=>'app\models\Activity']);
        $model = $comp->getModel();
        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
        }
        $comp->createActivity($model);

        return $this->controller->render('create',['model'=>$model]);
    }
}