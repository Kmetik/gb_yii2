<?php

namespace app\components\console;

use app\base\BaseComponent;
use DateTime;
use app\jobs\ActivityNotificationJob;

class NotificationComponent extends BaseComponent {

   
    public function getNotficationsList(){
        $date = new DateTime();
        $current = $date->modify('+ 8 hours')->format('Y-m-d H:i');
        $current5 = $date->modify('+ 5 minutes')->format('Y-m-d H:i');
        return $this->connection->createCommand('SELECT dateStart,timeStart,user_id,title,notifyTime,users.email,users.name FROM activities INNER JOIN users on users.id = activities.user_id WHERE notifyTime >= :current and notifyTime < :current5 and useNotification = 1 and active=1')
        ->bindValue(':current',$current)
        ->bindValue(':current5',$current5)
        ->queryAll();
    }
    public function notify() {
        foreach ($this->getNotficationsList() as $value) {
            \Yii::$app->queue->delay((5-(date('i',strtotime($value['notifyTime'])))%5)*60)->push(new ActivityNotificationJob([
                'activity'=>$value
            ]));
        }
    }
}