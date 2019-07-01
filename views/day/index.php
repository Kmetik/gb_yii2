<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = \Yii::$app->request->get('date');
$this->params['breadcrumbs'][] = ['label'=>'Календарь','url'=>'/calendar/'];
$this->params['breadcrumbs'][] = ['label'=>\Yii::$app->request->get('date'),'url'=>['/day/','date'=>\Yii::$app->request->get('date')]];
?>
<a class="btn btn-success" href="/activity/create?date=<?=\Yii::$app->request->get('date')?>">Добавить</a>
<div class="row">
       <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Заголовок</th>
      <th scope="col">Дата начала</th>
      <th scope="col">Дата окончания</th>
      <th scope="col">Описание</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($activities as $activity):?>
    <tr>
      <th scope="row"><?=$activity['id']?></th>
      <td><?=Html::a($activity['title'],['/activity','id'=>$activity['id']]);?></td>
      <td><?=$activity['dateStart']?> <?=$activity['timeStart']?></td>
      <td><?=$activity['dateFinish']?> <?=$activity['timeFinish']?></td>
      <td><?=$activity['description']?></td>
      <th scope="row">
                <a href=<?=Url::to(['activity/edit','id'=>$activity['id']])?> class="card-link">Изменить</a>
                <a href="#" class="card-link">Завершить</a>
        </th>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>