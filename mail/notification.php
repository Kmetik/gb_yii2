<?php
use yii\helpers\Html;

?>

<h2>Ищешь пароль?</h2>

<?=Html::a('тут он есть для тебя',['localhost/auth/restore', 'key'=>$key])?>