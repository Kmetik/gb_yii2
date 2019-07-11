<?php

namespace app\components;

use app\models\Users;
use app\base\BaseComponent;
use app\jobs\PasswordRestoreJob;

class AuthComponent extends BaseComponent {

    const RESTORE_EVENT='restore';
   
    public function singUp(Users &$model){
        $model->setScenarioSignUp();

        if(!$model->validate(['email','password'])) return false;

        $model->password_hash = $this->generatePasswordHash($model->password);
        $model->auth_key = $this->generateAuthKey();
        $model->auth_token = $this->generateAuthKey();

        if(!$model->save()) return false;
        
        $authManager = \Yii::$app->authManager;
        $role = $authManager->getRole('user');
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
        return true;
    }

    public function rememberPassword(Users $model) {
        $model->setScenarioRemember();
        $user = Users::find()->andWhere(['email'=>$model->email])->one();
        if($model->validate(['email'])) {
                \Yii::$app->queue->push(new PasswordRestoreJob([
                    'to'=>$user->email,
                    'key'=>$user->auth_key
                ]));
                return true;
            }
    }

    public function restorePassword(Users $model,$key) {
        $model->setScenarioRestorePass();


        $user = $this->getUserByAuthKey($key);

        if($model->validate(['password','repeatPassword'])) {
            $user->password_hash = $this->generatePasswordHash($model->password);
            $user->auth_key = $this->generateAuthKey(); 
            if(!$user->save()) return false;            
        }       
        return true; 
    }

    private function getUserByEmail($email){
        return Users::find()->andWhere(['email'=>$email])->one();
    }

    private function getUserByAuthKey($key) {
        return Users::find()->andWhere(['auth_key'=>$key])->one();
    }
    private function validatePassword($pass, $pass_hash) {
        return \Yii::$app->security->validatePassword($pass, $pass_hash);
    }

    public function generatePasswordHash($password) {
        return \Yii::$app->security->generatePasswordHash($password);
    }

    public function generateNewPassword() {
        return \Yii::$app->security->generateRandomString(6);
    }

    public function generateAuthKey() {
        return \Yii::$app->security->generateRandomString(32);
    }
}