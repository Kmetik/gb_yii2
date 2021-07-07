<?php

namespace app\behaviors;

use yii\base\Behavior;

class GetDateCreateBehavior extends Behavior {

    public $attribute_name;

    public function getDateCreated() {
        $date = $this->owner->($this->attribute_name);

        if($date) {
            return \Yii::$app->formatter->asDate($date);
        }

    }
}