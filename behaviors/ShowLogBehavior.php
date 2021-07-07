<?php

namespace app\behaviors;

use yii\base\Behavior;
use yii\log\Logger;
use yii\db\ActiveRecord;

class ShowLogBehavior extends Behavior {


    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND=>'inLog'
        ];
    }
    public function inLog() {
        \Yii::getLogger()->log('in logger event',Logger::LEVEL_WARNING);
    }
}