<?php
namespace app\base;

use yii\web\Controller;
use yii\web\HttpException;

class BaseWebController extends Controller {
    public $breadcrumbs;
    
    public function beforeAction($action)
    {
        if(\Yii::$app->user->isGuest) throw new HttpException(401,'неавторизованный пользователь');
        return parent::beforeAction($action);
    }
    public function afterAction($action, $result)
    {
        \Yii::$app->session->setFlash('prevURI',\Yii::$app->request->absoluteUrl);
        return parent::afterAction($action,$result);
    }
}