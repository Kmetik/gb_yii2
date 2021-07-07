<?php

namespace app\controllers\actions\activity;

use yii\base\Action;
use app\components\ActivityComponent;
use yii\web\Response as YiiResponse;
use yii\widgets\ActiveForm;
use yii\web\HttpException;

class ActivityCreateAction extends Action {
    public $name;
    public function run(){
        if(!\Yii::$app->rbac->canCreateActivity()){
           $this->controller->redirect(['/user/auth/login']);
        }

        $comp = \Yii::createObject(['class'=>ActivityComponent::class, 'model'=>'app\models\Activity']);
        $model = $comp->getModel();
        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            if(\Yii::$app->request->isAjax) {
                \Yii::$app->response->format=YiiResponse::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if($comp->createActivity($model)){
                $this->controller->redirect(['/activity','id'=>$model->id]);
            } 
        } else if(\Yii::$app->request->isGet) {
                $comp->getCreateActivity($model);
        }
        
        return $this->controller->render('create',['model'=>$model]);
    }
}