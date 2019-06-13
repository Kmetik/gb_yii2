<?php
namespace app\controllers\actions;

use yii\base\Action;


class DayIndexAction extends Action {
    public function run(){
        return $this->controller->render('index');
    }
}