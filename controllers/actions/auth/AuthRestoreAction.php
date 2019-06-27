<?php 

namespace app\controllers\actions\auth;

use yii\base\Action;
use app\components\AuthComponent;

class AuthRestoreAction extends Action {


    public function run($key) {
        $comp = \Yii::createObject(['class'=>AuthComponent::class,'model'=>'app\models\Users']);
        $model = $comp->getModel();

        if(\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if($comp->durakHelp($model,$key)) return $this->controller->redirect(['/auth/singin/']);
        
            
        }
        
        return $this->controller->render('restore',['model'=>$model]);
    }
}