<?php

namespace app\controllers;


use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;

class RestController extends ActiveController {
    public $modelClass = 'app\models\Activity';


    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator']=[
            'class'=>HttpBearerAuth::class
        ];

        $behaviors['corsFilter']  = [
            'class' => Cors::class,
            'cors'  => [
                'Origin'                           => ['localhost:8080', 'localhost:90'],
                'Access-Control-Request-Method'    => ['POST','GET','OPTIONS','PUT','DELETE'],
                'Access-Control-Allow-Credentials' => true,     
                'Access-Control-Allow-Origin' => true,       
            ],
        ];

        
        return $behaviors;
    }
}