<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property int $role
 * @property string $auth_token
 * @property string $auth_key
 * @property string $created_at
 *
 * @property Activities[] $activities
 */
class Users extends UsersBase implements IdentityInterface
{
    public $password;
    public $repeatPassword;
    const SCENARIO_SIGNUP='signup';
    const SCENARIO_SIGNIN='signin';
    const SCENARIO_REMEMBER='remember';
    const SCENARIO_CHANGEPASSWORD='newpassword';
    
    public function setScenarioSignUp()
    {
        $this->setScenario(self::SCENARIO_SIGNUP);
        return $this;
    }

    public function setScenarioSignIn()
    {
        $this->setScenario(self::SCENARIO_SIGNIN);
        return $this;
    }

    public function setScenarioRemember() {
        $this->setScenario(self::SCENARIO_REMEMBER);
        return $this;
    }
    

    public function attributeLabels()
    {
        return [
            'name'=>'Ваше имя',
            'password'=>'Пароль',
            'email'=>'Электронная почта'
        ];
    }
    public function rules() {
        return array_merge([
            ['email','unique','on'=>self::SCENARIO_SIGNUP],
            ['email','exist','on'=>self::SCENARIO_SIGNIN],
            ['email','required','on'=>self::SCENARIO_REMEMBER],
            ['password','string','min'=>6],
            ['repeatPassword','string', 'min'=>6],
            ['repeatPassword','required','on'=>self::SCENARIO_CHANGEPASSWORD],
            ['repeatPassword','compare','compareAttribute'=>'password']
        ], parent::rules());
    }

    public static function findIdentity($id)
    {
        return Users::find()->andWhere(['id'=>$id])->one();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_token' => $token]);
    }

}