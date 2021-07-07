<?php
use yii\bootstrap\ActiveForm;

?>

<div class="row">
    <h2>Восстановление пароля</h2>
    <div class="col-md-6">
        <?php $form= ActiveForm::begin();?>
        <?=$form->field($model,'password')->passwordInput();?>
        <?=$form->field($model,'repeatPassword')->passwordInput();?>
        
        <button type="submit">Напомнить</button>
        <?php ActiveForm::end();?>
    </div>
</div>