<?php 

namespace app\controllers;

use yii\web\Controller;
use app\controllers\actions\auth\AuthLoginAction;
use app\controllers\actions\auth\AuthRegAction;
use app\controllers\actions\auth\AuthLogoutAction;

class AuthController extends Controller {


    public function actions()
    {
        return [
            'login'=>AuthLoginAction::class,
            'reg'=>AuthRegAction::class,
            'logout'=>AuthLogoutAction::class
        ];
    }
        
}