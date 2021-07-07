<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
$this->params['breadcrumbs'][] = $model->title;


?>


<div class="row">
    <div class="col-4-md">
    <?= DetailView::widget([
    'model'=>$model,
    'attributes'=>[
        'description',
        [
            'attribute'=>'dateStart',
            'format'=>'html',
            'value'=> function($model) {
                return Html::a("$model->dateStart перейти ко дню",['/day/','date'=>$model->dateStart]);
            }    
        ],
        'timeStart',
        [
            'attribute'=>'dateFinish',
            'format'=>'html',
            'value'=> function($model) {
                return Html::a("$model->dateFinish перейти ко дню",['/day/','date'=>$model->dateFinish]);
            }    
        ],
        'timeFinish',
        'created_at:datetime'
    ]
]);?>
    
    </div>
</div>