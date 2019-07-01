<?php 

namespace app\modules\auth\controllers\actions;

use app\components\AuthComponent;
use yii\base\Action;


class AuthLoginAction extends Action {


    public function run(){

        $comp = \Yii::createObject(['class'=>AuthComponent::class,'model'=>'app\models\Users']);
        $model = $comp->getModel();
        if(\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if($comp->signIn($model)) {
              return $this->controller->redirect(['/calendar/']); 
            }
        }
        return $this->controller->render('signin',['model'=>$model]);
    }
}