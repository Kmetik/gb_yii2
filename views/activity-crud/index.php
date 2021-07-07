<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Activities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Activity'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'user_id',
            [
                'attribute'=>'email',
                'value'=>function($model) {
                    return $model->user->email;
                }    
            ],
            'user.email',
            [
                'attribute'=>'title',
                'value'=> function($model){
                    return Html::a($model->title,['/activity/','id'=>$model->id]);
                },
                'format'=>'html'
            ],
            'description:ntext',
            'dateStart',
            'timeStart',
            'dateFinish',
            'timeFinish',
            //'isBlocked',
            //'isRepeat',
            //'useNotification',
            //'repeatType',
            'active',
            'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
