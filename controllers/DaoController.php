<?php

namespace app\controllers;

use app\base\BaseWebController;
use app\components\DaoComponent;

class DaoController extends BaseWebController {
    
    public function actionTest(){
        $comp =\Yii::createObject(DaoComponent::class);

        $users = $comp->getUsersAll();
        $userActivities = $comp->getUserActivities(\Yii::$app->request->get('user'));
        return $this->render('test',['users'=>$users, 'activities'=>$userActivities]);
    }
}