<?php
namespace app\components;


use app\models\Activity;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use app\base\BaseComponent;

class ActivityComponent extends BaseComponent {
    
    public function createActivity(Activity &$model){
        $model->userFiles=UploadedFile::getInstances($model,'userFiles');
        if($model->validate() && $this->upload($model)) {
            $model->save();
            return true;
        } else return false;
    }
    public function upload(Activity &$model){
        FileHelper::createDirectory('images');
        foreach($model->userFiles as $file) {
            $file->saveAs('images/'.$file->baseName.'.'.$file->extension);
        }
    }
    public function getCreateActivity(Activity &$model) {
        $model->dateStart = \Yii::$app->request->get('date')?$model->dateStart = \Yii::$app->request->get('date'):date('Y-m-d');
        $model->timeStart = '08:00';   
        $model->dateFinish = \Yii::$app->request->get('date')?$model->dateStart = \Yii::$app->request->get('date'):date('Y-m-d');
        $model->timeFinish = '09:00';
    }

    public function getActivityById($id){
        return Activity::find()->andWhere(['id'=>$id])->one();
    }

    public function getActivityByDate($date){
        return Activity::find()->andWhere(['dateStart'=>$date, 'user_id'=>\Yii::$app->user->getId()])->all();
    }
    
    public function editActivity($id){
        return Activity::find()->andWhere(['id'=>$id])->one();
    }
}