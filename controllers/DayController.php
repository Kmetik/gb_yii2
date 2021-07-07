<?php
namespace app\controllers;

use app\base\BaseWebController;
use app\controllers\actions\DayIndexAction;

class DayController extends BaseWebController {
    public function actions(){
        return [
            'index'=>['class'=>DayIndexAction::class]
        ];
    }
}