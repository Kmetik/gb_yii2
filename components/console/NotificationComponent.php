<?php

namespace app\components\console;

use yii\base\Component;
use yii\helpers\Console;

class NotificationComponent extends Component {

    /** @var MailerInterface */
    public $mailer;


    public function sendNotification($activities) {
        
        foreach($activities as $activity) {


            $sended = $this->mailer->compose('notification',[
                'title'=>$activity->title,
                'description'=>$activity->description
            ])
            ->setFrom('aleksei.kmetik@yandex.ru')
            ->setTo($activity->email)
            ->setSubject('Перейди сюда')->send();

            if($sended) {
                echo Console::ansiFormat('sended mail to'.$activity->email,Console::FG_GREEN).PHP_EOL;
                
            }
        }
    }
}