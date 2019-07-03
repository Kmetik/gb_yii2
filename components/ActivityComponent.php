<?php
namespace app\components;


use app\models\Activity;
use yii\web\UploadedFile;
use app\base\BaseComponent;
use DateInterval;

class ActivityComponent extends BaseComponent {


    public function createActivity(Activity &$model):bool {
        $model->userFiles=UploadedFile::getInstances($model,'userFiles');
        $model->user_id = \Yii::$app->user->getId();
        if($model->validate()) {
            $model->save();
            if($model->isRepeat) {
                $this->connection->createCommand()->batchInsert('activities',$model->attributes(),$this->setActivityRepeat($model))->execute();
            }
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


    public function setActivityRepeat(Activity &$model):array {
        $start = new \DateTime("$model->dateStart + $model->repeatType");
        $end = new \DateTime("$model->dateFinish + $model->repeatType");
        $diff = $start->diff($end)->format('%R%a days');
        $period = new \DatePeriod(
            $start,
            DateInterval::createFromDateString($model->repeatType),
            new \DateTime("$model->repeatEnd +1 day")   
        );
        
        $relay = $model->id;
        $batch=[];
        
        foreach($period as $date) {
            $model->dateStart=$date->format('Y-m-d');
            $model->dateFinish=date('Y-m-d',strtotime("$model->dateStart +$diff"));
            $model->active = 1;
            $model->id++;
            $model->relatesToId = $relay;
            array_push($batch,$model->attributes);
        }

    return $batch;

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
    public function getActivityById($id) {
        $model = Activity::find()->andWhere(['id'=>$id])->one();
        if(!$model) return false;
        return $model;
    }

    public function getUserFilesByActivityId($id):array {
        return $this->connection->createCommand('select fileURL from userFiles where activity_id = :id',[':id'=>$id])->queryAll();
    }



    public function getActivityByDate($date):array {
        
        return Activity::find()->andWhere(['dateStart'=>$date, 'user_id'=>\Yii::$app->user->getId(),'active'=>1])->all();
    }
    
    public function editActivity(Activity &$model):bool {
            if($model->updateRelations && $model->isRepeat) {
                if($model->isAttributeChanged('dateStart') || $model->isAttributeChanged('dateFinish') || $model->isAttributeChanged('repeatEnd') || $model->isAttributeChanged('repeatType'))
                    {
                        $model->deleteAll(['relatesToid'=>$model->relatesToId]);
                        $this->createActivity($model);
                        
                    }
                $model->updateAll($model->getAttributes(null,['id','dateStart','dateFinish']),
                [
                    'relatesToId'=>$model->relatesToId,
                    'user_id'=>$model->user_id
                ]);

                return true;
                
            } else if($model->save()) {
                return true;
            }
            return false;
    }


}