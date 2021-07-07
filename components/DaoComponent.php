<?php

namespace app\components;

use yii\base\Component;
use yii\db\Connection;

class DaoComponent extends Component {
    public $connection;

    public function init(){
        $this->connection=\Yii::$app->db;
        parent::init();
    }
    public function getUserActivities($user_id)
    {
       $sql = "Select * from activities where user_id=:user";

       return $this->connection->createCommand($sql,[':user'=>$user_id])->queryAll();
       
    }
    public function getUsersAll(){
        $sql="SELECT * FROM users";

        return $this->connection->createCommand($sql)->queryAll();   
    }
}