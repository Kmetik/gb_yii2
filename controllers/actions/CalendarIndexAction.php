<?php 
namespace app\controllers\actions;

use app\components\CalendarComponent;
use yii\base\Action;

class CalendarIndexAction extends Action {
    public function run()
    {
        $comp = \Yii::createObject(['class'=>CalendarComponent::class,'model'=>'app\models\Calendar']);
        $model = $comp->getModel();   
        if(\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
        } else {
            $model->date = date('Y-m-d'); 
        }
        $grid = $comp->getMonthGrid($model);
        return $this->controller->render('index',['model'=>$model, 'grid'=>$grid]);
    }
}