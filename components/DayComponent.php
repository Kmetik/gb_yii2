<?php
namespace app\components;

use yii\base\Component;

class DayComponent extends Component {
    public $model;
    public function getModel(){
        return new $this->model;
    }
    
}