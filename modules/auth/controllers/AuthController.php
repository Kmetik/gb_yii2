<?php 

namespace app\modules\auth\controllers;

use yii\web\Controller;
use app\modules\auth\controllers\actions\AuthLoginAction;
use app\modules\auth\controllers\actions\AuthRegAction;
use app\modules\auth\controllers\actions\AuthLogoutAction;
use app\modules\auth\controllers\actions\AuthRememberAction;
use app\modules\auth\controllers\actions\AuthRestoreAction;

class AuthController extends Controller {


    public function actions()
    {
        return [
            'login'=>AuthLoginAction::class,
            'reg'=>AuthRegAction::class,
            'logout'=>AuthLogoutAction::class,
            'remember'=>AuthRememberAction::class,
            'restore'=> AuthRestoreAction::class
        ];
    }
        
}