<?php
namespace app\components;


use app\models\Day;
use yii\base\Component;
use yii\db\Query;

class DayComponent extends Component {
    public $model;
    public function getModel(){
        return new $this->model;
    }
    public function getActivities(Day &$model){
        $query = new Query();
        return $query->select('*')->from('activities')->where(['dateStart'=>$model->date])->andWhere(['user_id'=>2])->all();
    }
}