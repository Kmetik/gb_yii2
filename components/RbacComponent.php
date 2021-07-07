<?php

namespace app\components;

use app\base\BaseComponent;
use app\rules\OwnerActivityRule;

class RbacComponent extends BaseComponent {

    private function getAuthManager() {
        return \Yii::$app->authManager;
    }

    public function gen(){
        $authManager = $this->getAuthManager();

        $authManager->removeAll();

        $admin = $authManager->createRole('admin');
        $user = $authManager->createRole('user');

        $authManager->add($admin);
        $authManager->add($user);

        $createActivity = $authManager->createPermission('createActivity');
        $createActivity->description='создание задачи';

        $authManager->add($createActivity);
        
        $allPrivileges = $authManager->createPermission('allPriveleges');
        $allPrivileges->description= 'полный доступ';

        $authManager->add($allPrivileges);

        $authManager->addChild($user,$createActivity);
        
        $authManager->addChild($admin,$createActivity);
        $authManager->addChild($admin,$allPrivileges);


        $viewEdit = $authManager->createPermission('viewEditOwner');
        $viewEdit->description='редактирование и просмотр события';
        
        $rule = new OwnerActivityRule();
        $authManager->add($rule);
        $viewEdit->ruleName = $rule->name;
        $authManager->add($viewEdit);

        
        $authManager->addChild($admin,$viewEdit);
        $authManager->addChild($user,$viewEdit);
        $authManager->assign($user,2);
        $authManager->assign($admin,1);


    }

    public function canCreateActivity(){
        return \Yii::$app->user->can('createActivity');
    }

    public function watchActivties() {
        return \Yii::$app->user->can('viewEditOwner');
    }

    public function canViewOrEditActivity($activity) {
        if(\Yii::$app->user->can('allPrivileges')){
            return true;
        }
        return \Yii::$app->user->can('viewEditOwner',[
            'activity'=>$activity
        ]);
    }
}