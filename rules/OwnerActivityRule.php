<?php

namespace app\rules;

use yii\rbac\Rule;
use yii\helpers\ArrayHelper;

class OwnerActivityRule extends Rule {
    
    public $name = 'ownerActivityRule';

    public function execute($user, $item, $params)
    {
        $activity = ArrayHelper::getValue($params,'activity');
        if(!$activity) {
            return false;
        }
        return $activity->user_id==$user;
    }
}