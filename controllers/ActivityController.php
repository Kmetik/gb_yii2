<?php
namespace app\controllers;

use app\base\BaseWebController;
use app\controllers\actions\ActivityCreateAction;

class ActivityController extends BaseWebController {
    // public function actionCreate(){

    // }
    public function actions()
    {
        return [
            'create'=>['class'=>ActivityCreateAction::class],
            'new'=>['class'=>ActivityCreateAction::class]
        ];
    }
}
?>