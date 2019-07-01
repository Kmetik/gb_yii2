<?php
use yii\widgets\DetailView;
use yii\bootstrap\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label'=>'Календарь','url'=>'/calendar/'];
$this->params['breadcrumbs'][] = ['label'=>$model->dateStart,'url'=>['/day/','date'=>$model->dateStart]];
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
        ['attribute'=>'timeStart','value'=>function($model){
            return \Yii::$app->formatter->asTime($model->timeStart,'php: H:i');
        }],
        [
            'attribute'=>'dateFinish',
            'format'=>'html',
            'value'=> function($model) {
                return Html::a("$model->dateFinish перейти ко дню",['/day/','date'=>$model->dateFinish]);
            }    
        ],
        ['attribute'=>'timeFinish','value'=>function($model){
            return \Yii::$app->formatter->asTime($model->timeFinish,'php: H:i');
        }],
        'created_at:datetime',

    ]
]);?>
    </div>
    <?php foreach($model->userFiles as $file):?>
    <?=Html::img($file['fileURL'],['height'=>200])?>
    <?php endforeach;?>
</div>