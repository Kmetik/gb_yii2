<?php
use yii\bootstrap\ActiveForm;

?>

<div class="row">
    <h2>Напоминание пароля по средствам почты</h2>
    <div class="col-md-6">
        <?php $form= ActiveForm::begin();?>
        <?=$form->field($model,'email');?>
        <button type="submit">Напомнить</button>
        <?php ActiveForm::end();?>
    </div>
</div>