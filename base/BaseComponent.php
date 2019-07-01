<?php

namespace app\base;

use yii\base\Component;

class BaseComponent extends Component {
    public $model;
    /** @var yii\db\Connection $connection */
    public $connection;

    public function init(){
        $this->connection=\Yii::$app->db;
        parent::init();
    }
    
    public function getModel(){
        return new $this->model;
    }

}