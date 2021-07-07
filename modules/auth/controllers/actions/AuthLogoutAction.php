<?php 

namespace app\modules\auth\controllers\actions;

use yii\base\Action;


class AuthLogoutAction extends Action {
    public function run(){
        if(\Yii::$app->user->logout()) {
            $this->controller->redirect(['/']);
        }
    }
}