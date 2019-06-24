<?php

namespace app\components;

use app\models\Users;
use app\base\BaseComponent;

class AuthComponent extends BaseComponent {
   
    public function singUp(Users &$model){
        $model->setScenarioSignUp();

        if(!$model->validate(['email','password'])) return false;

        $model->password_hash = $this->generatePasswordHash($model->password);


        if(!$model->save()) return false;
        
        $authManager = \Yii::$app->authManager;
        $role = $authManager->getRole('admin');
        $authManager->assign($role,$model->id);
        

        return true;
    }

    public function signIn(Users &$model) {

        $model->setScenarioSignIn();

        if(!$model->validate(['email'])) return false;

        $user=$this->getUserByEmail($model->email);

        if(!$this->validatePassword($model->password,$user->password_hash)) {
            $model->addError('password','Неверный пароль');
            return false;
        }
        
        \Yii::$app->user->login($user,3600);

    }

    private function getUserByEmail($email){
        return Users::find()->andWhere(['email'=>$email])->one();
    }

    private function validatePassword($pass, $pass_hash) {
        return \Yii::$app->security->validatePassword($pass, $pass_hash);
    }

    public function generatePasswordHash($password) {
        return \Yii::$app->security->generatePasswordHash($password);
    }
}