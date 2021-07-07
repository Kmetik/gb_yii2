<?php

namespace app\models;

use yii\base\Model;

class Calendar extends Model {
    public $date;
    public function rules()
    {
        return [
            ['date','datetime']
        ];
    } 
}

