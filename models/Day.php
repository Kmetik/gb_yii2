<?php
namespace app\models;

use yii\base\Model;

class Day extends Model {
    public $activities;
    public $daytype; // dayoff = 1; workday = 0;
    
}