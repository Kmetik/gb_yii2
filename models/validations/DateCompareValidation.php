<?php
namespace app\models\validations;

use yii\validators\Validator;

class DateCompareValidation extends Validator {
    public function validateAttributes($model, $attributes = null)
    {
        if($model->dateFinish < $model->dateStart) {
            $model->addError('dateFinish','Дата окончания не может быть меньше даты начала события');
        }
        if($model->dateFinish === $model->dateStart && $model->timeFinish <= $model->timeStart){
            $model->addError('timeFinish','Время начала события не может быть меньше времени окончания в одну дату');
        }
    }
}