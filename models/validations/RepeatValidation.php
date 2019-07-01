<?php

namespace app\models\validations;

use yii\validators\Validator;

class RepeatValidation extends Validator {

    public function validateAttributes($model, $attributes = null)
    {
        if($model->isRepeated) {
            $start = new \DateTime($model->dateStart);
            $end = new \DateTime($model->repeatEnd);
            $diff = $start->diff($end)->format('%R%a');
            if($diff < $model->repeatType ) {
                $model->addErrors([
                    'repeatEnd' =>'',
                    'dateEnd'=>''
                ]); //TODO дописать блок, определиться с форматом repeatType;
            }
        }
    }
}