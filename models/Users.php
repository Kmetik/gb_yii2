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
    const SCENARIO_SIGNUP='signup';
    const SCENARIO_SIGNIN='signin';
    
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
    
    public function rules() {
        return array_merge([
            ['email','unique','on'=>self::SCENARIO_SIGNUP],
            ['email','exist','on'=>self::SCENARIO_SIGNIN],
            ['password','string','min'=>6]
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