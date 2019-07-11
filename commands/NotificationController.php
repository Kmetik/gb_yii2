<?php

namespace app\commands;

use yii\console\Controller;
use app\components\console\NotificationComponent;

class NotificationController extends Controller {

    public function actionSend() {
        $comp= \Yii::createObject(['class'=>NotificationComponent::class]);
        $comp->notify();
    }
}

