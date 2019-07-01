<?php
use yii\bootstrap\ActiveForm;

?>

<div class="row">
<h2>Регистрация нового пользователя, должна автоматически делать:</h2>
<ul>
    <li>Хэш пароля</li>
    <li>Ключ аутентификации</li>
</ul>
    <div class="col-md-6">
        <?php $form= ActiveForm::begin();?>
        <?=$form->field($model,'name');?>
        <?=$form->field($model,'email');?>
        <?=$form->field($model,'password')->passwordInput();?>
        <button type="submit" class="btn btn-primary">Регистрация</button>
        <?php ActiveForm::end();?>
    </div>
</div>