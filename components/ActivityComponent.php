<?php
namespace app\components;

use yii\base\Component;
use app\models\Activity;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class ActivityComponent extends Component {
    
    public $modelClass;

    public function getModel(){
        return new $this->modelClass;
    }
    public function createActivity(Activity &$model){
        $model->userFiles=UploadedFile::getInstances($model,'userFiles');
        if($model->validate() && $this->upload($model)) {
            return true;
        } else return false;
    }
    public function upload(Activity &$model){
        FileHelper::createDirectory('images');
        foreach($model->userFiles as $file) {
            $file->saveAs('images/'.$file->baseName.'.'.$file->extension);
        }
    }
}