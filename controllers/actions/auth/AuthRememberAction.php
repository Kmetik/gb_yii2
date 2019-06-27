<?php

namespace app\controllers\actions\auth;

use yii\base\Action;
use app\components\AuthComponent;

class AuthRememberAction extends Action {


    public function run() {
        $comp = \Yii::createObject(['class'=>AuthComponent::class,'model'=>'app\models\Users']);
        $model = $comp->getModel();

        if(\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if($comp->userDurak($model)) {
                return $this->controller->render('await');
            }
        }

        return $this->controller->render('remember', ['model' => $model]);      
    }
}