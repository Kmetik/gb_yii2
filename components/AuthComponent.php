<?php

namespace app\components;

use app\models\Users;
use app\base\BaseComponent;
use yii\mail\MailerInterface;
use yii\web\HttpException;

class AuthComponent extends BaseComponent {
   
    public function singUp(Users &$model){
        $model->setScenarioSignUp();

        if(!$model->validate(['email','password'])) return false;

        $model->password_hash = $this->generatePasswordHash($model->password);
        $model->auth_key = $this->generateAuthKey();

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

    }

    public function userDurak(Users $model) {
        $model->setScenarioRemember();
        $user = Users::find()->andWhere(['email'=>$model->email])->one();
        if($model->validate(['email'])) {
           $notify = \Yii::$app->mailer->compose('notification',[
                'key'=>$user->auth_key
            ])
            ->setFrom('aleksei.kmetik@yandex.ru')
            ->setTo($model->email)
            ->setSubject('Перейди сюда')->send();
            if($notify) return true;
            else return false;
        }
    }

    public function durakHelp(Users $model,$key) {

        if(Users::find()->andWhere(['auth_key'=>$key])->one() && !\Yii::$app->user->identity) {

            throw new HttpException(406, 'Ай-яй-яй, что сейчас произошло!!!');

        } else {
            if($model->validate(['password','repeatPassword'])) {
                $model->password_hash = $this->generatePasswordHash($model->password);
                if(!$model->save()) return false;
            }    
            return true; 
        }

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

    public function generateNewPassword() {
        return \Yii::$app->security->generateRandomString(6);
    }

    public function generateAuthKey() {
        return \Yii::$app->security->generateRandomString(32);
    }
}