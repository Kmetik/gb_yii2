<?php

namespace app\modules\auth\controllers;

use yii\console\Controller;
use app\models\Activity;

class DefaultController extends Controller {

    public function actionIndex() {
        $model = Activity::find()->andWhere(['active'=>1,'user_id'=>\Yii::$app->user->id])->orderBy('dateStart')->all();
        return $this->render('index',['model'=>$model]);
    }
}