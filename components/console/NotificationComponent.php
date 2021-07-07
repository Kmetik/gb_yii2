<?php

namespace app\components\console;

use yii\base\Component;

class NotificationComponent extends Component {

    /** @var MailerInterface */
    public $mailer;


    public function sendNotification($activities) {
        
        foreach($activities as $activity) {


            $this->mailer->compose('notification',[
                'title'=>$activity->title,
                'description'=>$activity->description
            ])
            ->setFrom('aleksei.kmetik@yandex.ru')
            ->setTo($activity->email)
            ->setSubject('Перейди сюда')->send();
        }
    }
}