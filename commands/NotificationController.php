<?php

namespace app\commands;

use yii\console\Controller;

class NotificationController extends Controller {

    public $date;

    public function optionAliases()
    {
        return [
            'd'=>'date'
        ];  
    }

    public function options($actionID)
    {
        return [
            'date'
        ];
    }

    public function actionTest() {
        echo 'ok '.PHP_EOL;

        print_r($this->date);
    }


    public function actionSend() {
        
    }
}

