<?php 

namespace app\controllers\actions\auth;

use yii\base\Action;


class AuthLogoutAction extends Action {
    public function run(){
        if(\Yii::$app->user->logout()) {
            $this->controller->redirect(['/']);
        }
    }
}