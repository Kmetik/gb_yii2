<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<h2>Ищешь пароль?</h2>

<?=Html::a('тут он есть для тебя',['/user/auth/restore', 'key'=>$key]);?>