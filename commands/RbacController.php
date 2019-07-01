<?php

namespace app\commands;

use yii\console\Controller;

class RbacController extends Controller {

    public function actionGet() {
        \Yii::$app->rbac->gen();

        echo 'права установлены'.PHP_EOL;
    }
}