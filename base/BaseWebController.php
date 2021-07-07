<?php
namespace app\base;

use yii\web\Controller;
use yii\web\HttpException;

class BaseWebController extends Controller {
    public $params;
    

    
    public function beforeAction($action)
    {
        if(\Yii::$app->user->isGuest) $this->redirect(['/user/auth/login']); 
        return parent::beforeAction($action);
    }
    public function afterAction($action, $result)
    {
        \Yii::$app->session->setFlash('prevURI',\Yii::$app->request->absoluteUrl);
        return parent::afterAction($action,$result);
    }
}