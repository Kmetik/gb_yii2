<?php
use yii\bootstrap\ActiveForm;

?>

<div class="row">
    <div class="col-md-6">
        <?php $form= ActiveForm::begin();?>
        <?=$form->field($model,'email');?>
        <?=$form->field($model,'password')->passwordInput();?>
        <button type="submit">Вход</button>
        <?php ActiveForm::end();?>
    </div>
</div>