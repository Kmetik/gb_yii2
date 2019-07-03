<?php

namespace app\models\validations;

use yii\validators\Validator;

class RepeatValidation extends Validator {

    public function validateAttributes($model, $attributes = null)
    {
        if($model->isRepeat) {
            $start = new \DateTime($model->dateStart);
            $end = new \DateTime($model->repeatEnd);
            $diff = $start->diff($end)->format('%R%a');
            if(strtotime($diff) > strtotime($model->repeatType )) {
                $model->addErrors([
                    'repeatEnd' =>'Дата завершения повторения события не может быть меньше интервала повторения'
                ]); //TODO дописать блок, определиться с форматом repeatType;
            }
        }
    }
}