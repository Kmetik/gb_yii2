<?php

namespace app\jobs;

use yii\base\BaseObject;
use yii\queue\JobInterface;

class ActivityNotificationJob extends BaseObject implements JobInterface {

    /**
    * @var Array|Activity[]
     */
    public $activity;

    /**
     * @param Queue $queue which pushed and is handling the job
     * @return void|mixed result of the job execution
     */
     public function execute($queue){
        \Yii::$app->mailer->compose('activity',[
            'dateStart'=>$this->activity['dateStart'],
            'timeStart'=>$this->activity['timeStart'],
            'title'=>$this->activity['title']

        ])->setFrom('aleksei.kmetik@yandex.ru')
        ->setTo($this->activity['email'])
        ->setSubject('Уведомление о приближающимся событии')
        ->send();
        
        echo $this->activity['email'].PHP_EOL;
     }
}