<?php
namespace app\components;

use yii\base\Component;
use app\models\Activity;

class ActivityComponent extends Component {
    
    public $modelClass;

    public function getModel(){
        return new $this->modelClass;
    }
    public function createActivity(Activity &$model){
        if($model->validate()) {
            return true;
        }
        return false;
    }
}