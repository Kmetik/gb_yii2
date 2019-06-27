<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dateStart')->textInput() ?>

    <?= $form->field($model, 'timeStart')->textInput() ?>

    <?= $form->field($model, 'dateFinish')->textInput() ?>

    <?= $form->field($model, 'timeFinish')->textInput() ?>

    <?= $form->field($model, 'isBlocked')->textInput() ?>

    <?= $form->field($model, 'isRepeat')->textInput() ?>

    <?= $form->field($model, 'useNotification')->textInput() ?>

    <?= $form->field($model, 'repeatType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
