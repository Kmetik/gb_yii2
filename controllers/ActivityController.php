<?php
namespace app\controllers;

use app\base\BaseWebController;
use app\controllers\actions\activity\ActivityCreateAction;
use app\controllers\actions\activity\ActivityIndexAction;
use app\controllers\actions\activity\ActivityEditAction;
use yii\web\HttpException;

class ActivityController extends BaseWebController {

    public function actions()
    {
        return [
            'create'=>['class'=>ActivityCreateAction::class],
            'new'=>['class'=>ActivityCreateAction::class],
            'index'=>['class'=>ActivityIndexAction::class],
            'edit'=>['class'=>ActivityEditAction::class]
        ];
    }
}
?>