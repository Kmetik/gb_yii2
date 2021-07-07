<?php
namespace app\base;

use yii\web\Controller;

class BaseWebController extends Controller {
    public $breadcrumbs;
    public function afterAction($action, $result)
    {
        \Yii::$app->session->setFlash('prevURI',\Yii::$app->request->absoluteUrl);
        return parent::afterAction($action,$result);
    }
}