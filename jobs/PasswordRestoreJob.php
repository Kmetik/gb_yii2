<?php

namespace app\jobs;

use yii\base\BaseObject;
use yii\queue\JobInterface;

class PasswordRestoreJob extends BaseObject implements JobInterface {

    
    public $to;
    public $key;


    /**
     * @param Queue $queue which pushed and is handling the job
     * @return void|mixed result of the job execution
     */


    public function execute($queue) {
            \Yii::$app->mailer->compose('notification',[
                'key'=>$this->key
            ])
            ->setFrom('aleksei.kmetik@yandex.ru')
            ->setTo($this->to)
            ->setSubject('Восстановление пароля от сервиса')->send();
    }

}