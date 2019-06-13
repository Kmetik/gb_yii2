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
        <?=$form->field($model, 'description')->textarea();?>
        <?=$form->field($model, 'isBlocked')->checkbox();?>
        <div class="form-group"><button class="btn" type="submit">Отправить</button></div>  
        <?php ActiveForm::end();?>
    </div>
</div>

