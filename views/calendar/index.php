<?php 
use yii\BaseYii;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<div class="container-fluid">
    <h2>Calendar</h2>
    <?php $form=ActiveForm::begin();?>
    <div class="col-6-md form-group">  
    <?=$form->field($model,'date')->input('datetime',[
        'type'=>'date'
    ]);
     ?>
     </div>
     <div class="form-group"><button class="btn" type="submit">Перейти</button></div>  
     <?php $form->end();?>
    <div class="calendar">
    <?php 
    $year = date('Y',strtotime($model->date));
    if(isset($grid['previous'])) foreach($grid['previous']['days'] as $key => $val):?>
        <?php 
        $month = $grid['previous']['month'];
        $dayName = \Yii::$app->formatter->asDate("$year-$month-$val",'php:D');?>
        <?="<div class='previous month'>
        <span>$dayName</span>
        $val</div>"?>
    <?php endforeach;?>
    <?php foreach($grid['current']['days'] as $key => $val):?>
    <?php 
        $month = $grid['current']['month'];
        $dayName = \Yii::$app->formatter->asDate("$year-$month-$val",'php:D');?>
        <?php $active=date('Y-m-d',strtotime("$year-$month-$val"))==date('Y-m-d')?'active-date-square':'';
            $date=date('Y-m-d',strtotime("$year-$month-$val"))
        ?>
        <?="
        <div class='current month $active'>
        <a class='month-link' href='../day?date=$date'>
        <span>$dayName
        </span>
        <span>$val</span>
        </a>
        </div>
        "?>
    <?php endforeach;?>
    
    <?php if(isset($grid['next'])) foreach($grid['next']['days'] as $key => $val):?>
    <?php 
        $month = $grid['next']['month'];
        $dayName = \Yii::$app->formatter->asDate("$year-$month-$val",'php:D');?>
<?="<div class='next month'>
        <span>$dayName
        </span>
        $val</div>"?>
    <?php endforeach;?>
    </div>
</div>