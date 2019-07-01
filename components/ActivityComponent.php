<?php
namespace app\components;


use app\models\Activity;
use yii\web\UploadedFile;
use app\base\BaseComponent;

class ActivityComponent extends BaseComponent {

    public const REPEAT_LENGTH = [1=>'1day',7=>'1week',29.3=>'1month'];
    
    public function createActivity(Activity &$model):bool {
        $model->userFiles=UploadedFile::getInstances($model,'userFiles');
        $model->user_id = \Yii::$app->user->getId();
        if($model->validate()) {
            $model->save();
            $this->upload($model, $model->id);
            return true;
        } else { 
            return false;
        }
    }
    public function upload(Activity &$model, $id):bool {
    
        foreach($model->userFiles as $file) {
            $fileURL = $this->getFileName($file);
            $file->saveAs($fileURL);
            $this->connection->createCommand('INSERT INTO userFiles (user_id, activity_id, fileURL) VALUES (:user_id,:activity_id,:fileURL);',
            [
                'user_id' => $model->user_id, 'activity_id' => $id, 'fileURL' => $fileURL
            ])->execute();
        }
        return true;
    }


    public function setActivityRepeat(Activity &$model) {
        $start = new \DateTime($model->dateStart);
        $end = new \DateTime($model->dateFinish);
        $diff = $start->diff($end)->format('%R%a days');
        $period = new \DatePeriod(
            $start,
            new \DateInterval($model->repeatType),
            new \DateTime($model->repeatEnd)   
        );
        $batch=[];
        foreach($period as $date) {
            $model->dateStart=$date->format('Y-m-d');
            $model->dateFinish=date('Y-m-d',strtotime("$model->dateStart +$diff"));
            ++$model->id;
            array_push($batch,$model->attributes);
        }
        if($this->connection->createCommand()->batchInsert('activities',$model->attributes(),$batch)->execute())
        {
            echo 'yesyesyes!';
        } else {
            echo 'kuku';
        }
        exit;

    }

    public function getCreateActivity(Activity &$model) {
        $model->dateStart = \Yii::$app->request->get('date')?$model->dateStart = \Yii::$app->request->get('date'):date('Y-m-d');
        $model->timeStart = '08:00';   
        $model->dateFinish = \Yii::$app->request->get('date')?$model->dateStart = \Yii::$app->request->get('date'):date('Y-m-d');
        $model->timeFinish = '09:00';
    }

    public function getFileName($file):string {
        return 'images/'.$file->baseName.'.'.$file->extension;
    }
    public function getActivityById($id):Activity {
        return Activity::find()->andWhere(['id'=>$id])->one();
    }

    public function getUserFilesByActivityId($id):array {
        return $this->connection->createCommand('select fileURL from userFiles where activity_id = :id',[':id'=>$id])->queryAll();
    }



    public function getActivityByDate($date):array {
        return Activity::find()->andWhere(['dateStart'=>$date, 'user_id'=>\Yii::$app->user->getId()])->all();
    }
    
    public function editActivity(Activity &$model):bool {
        if($model->save()) {
            return true;
        }
        return false;
    }
}