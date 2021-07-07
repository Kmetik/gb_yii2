<?php
use yii\bootstrap\ActiveForm;

/**
* @var $model \app\models\Activity
*/
?>

<h2>Добавление события</h2>
<div class="row">
    <div class="col-md-6">
        <?php $form =ActiveForm::begin();?>
        <?=$form->field($model, 'title');?>
        <?=$form->field($model,'dateStart')->input('date');?>
        <?=$form->field($model,'timeStart')->input('time');?>
        <?=$form->field($model,'dateFinish')->input('date');?>
        <?=$form->field($model,'timeFinish')->input('time');?>
        <?=$form->field($model, 'description')->textarea();?>
        <?=$form->field($model,'isRepeat')->checkbox();?>
        <?=$form->field($model,'repeatType')->dropDownList($model::REPEAT_TYPE);?>
        <?=$form->field($model, 'isBlocked')->checkbox();?>
        <?=$form->field($model,'useNotification')->checkbox();?>
        <?=$form->field($model, 'email',['enableAjaxValidation'=>true,'enableClientValidation'=>false]);?>
        <?=$form->field($model,'userFiles[]')->fileInput(['multiple'=>true,'accept'=>'image/+']);?>
        <div class="form-group"><button class="btn btn-primary" type="submit">Отправить</button></div>  
        <?php ActiveForm::end();?>
    </div>
</div>

