<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'dateStart') ?>

    <?php // echo $form->field($model, 'timeStart') ?>

    <?php // echo $form->field($model, 'dateFinish') ?>

    <?php // echo $form->field($model, 'timeFinish') ?>

    <?php // echo $form->field($model, 'isBlocked') ?>

    <?php // echo $form->field($model, 'isRepeat') ?>

    <?php // echo $form->field($model, 'repeatType') ?>

    <?php // echo $form->field($model, 'repeatEnd') ?>

    <?php // echo $form->field($model, 'useNotification') ?>

    <?php // echo $form->field($model, 'notifyType') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
