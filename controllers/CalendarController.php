<?php
namespace app\controllers;

use app\base\BaseWebController;
use app\controllers\actions\CalendarIndexAction;


class CalendarController extends BaseWebController {
    public function actions()
    {
        return [
            'index'=>['class'=>CalendarIndexAction::class]
        ];
    }
}