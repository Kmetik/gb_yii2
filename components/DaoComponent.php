<?php

namespace app\components;

use app\base\BaseComponent;

class DaoComponent extends BaseComponent {
    
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