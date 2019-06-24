<?php
namespace app\components;

use app\base\BaseComponent;

class CalendarComponent extends BaseComponent {

    public function getFirstDayOffset(&$model){
        $month = date('Y-n-1',strtotime($model->date));
        return date('N',strtotime("$month"))-1;
    }
    public function getMonthDaysCount(&$model){
        return cal_days_in_month(0,date('m',strtotime($model->date)),date('Y',strtotime($model->date)));
    }
    public function getMonthGrid(&$model) {
        $calendar['current']['days'] = range(1, $this->getMonthDaysCount($model));
        $calendar['current']['month'] = date('m',strtotime($model->date));
        date('m',strtotime($model->date)) != 1? $prevMonth = date('m',strtotime($model->date))-1: $prevMonth = 12;
        $offset = $this->getFirstDayOffset($model);
        $prevMonthDays = cal_days_in_month(0,$prevMonth,date('Y',strtotime($model->date)));
        if($offset !==0) {
            $calendar['previous']['days'] = range($prevMonthDays-$offset+1,$prevMonthDays);
            $calendar['previous']['month'] = $prevMonth;
        }
        if(count($calendar['current']['days'])+$offset < 35) {
            $calendar['next']['days'] = range(1, 35 - (count($calendar['current']['days'])+$offset));
            $calendar['next']['month'] = date('m',strtotime($model->date))+1;
        } else if($offset === 6) {
            $calendar['next']['days'] = range(1, 42 - (count($calendar['current']['days'])+$offset));
            $calendar['next']['month'] = date('m',strtotime($model->date))+1;
        }
        return $calendar;
    }  
}