<?php

namespace app\controllers;

use app\base\BaseWebController;
use app\components\RbacComponent;

class RbacController extends BaseWebController {

    public function actionGet() {
        \Yii::$app->rbac->gen();
    }
}