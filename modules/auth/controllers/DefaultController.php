<?php

namespace app\modules\auth\controllers;

use app\models\Activity;
use app\base\BaseWebController;

class DefaultController extends BaseWebController {

    public function actionIndex() {
        $model = Activity::find()->andWhere(['active'=>1,'user_id'=>\Yii::$app->user->id])->orderBy('dateStart')->cache(60)->all();
        return $this->render('index',['model'=>$model]);
    }
}