<?php

namespace app\modules\auth\controllers;

use yii\console\Controller;

class DefaultController extends Controller {

    public function actionIndex() {
        return $this->render('index');
    }
}