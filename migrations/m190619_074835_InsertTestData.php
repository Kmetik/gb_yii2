<?php

use yii\db\Migration;

/**
 * Class m190619_074835_InsertTestData
 */
class m190619_074835_InsertTestData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users',[
            'name'=>'Админ',
            'id'=>1,
            'email'=>'test@test.ru',
            'password_hash'=>\Yii::$app->security->generatePasswordHash('123456'),
            'auth_key'=>\Yii::$app->authComp->generateAuthKey()
        ]);

        $this->insert('users',[
            'name'=>'Работяга',
            'id'=>2,
            'email'=>'test2@test.ru',
            'password_hash'=>\Yii::$app->security->generatePasswordHash('123456'),
            'auth_key'=>\Yii::$app->authComp->generateAuthKey()
        ]);

        $this->batchInsert('activities',[
            'user_id','title','description','dateStart','timeStart','dateFinish','timeFinish'],[
            [
                1,
                'Встать','чтобы лечь',
                \Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('08:00','php: G:i'),\Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('09:00','php: G:i')],
            [
                1,
                'Умыться','чтобы лечь',
                \Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('09:00','php: G:i'),\Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('09:15','php: G:i')],
            [
                1,
                'Поесть','чтобы лечь',
                \Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('08:00','php: G:i'),\Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('09:00','php: G:i')],
            [
                1,
                'Сделать важное дело','чтобы лечь',
                \Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('14:00','php: G:i'),\Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('18:00','php: G:i')],
            [
                1,
                'Неважно что, лишь бы','чтобы лечь',
                \Yii::$app->formatter->asDate('2019-06-20','php: Y-m-d'),\Yii::$app->formatter->asTime('23:00','php: G:i'),\Yii::$app->formatter->asDate('2019-06-20','php: Y-m-d'),\Yii::$app->formatter->asTime('23:05','php: G:i')],
        ]);

        $this->batchInsert('activities',[
            'user_id','title','description','dateStart','timeStart','dateFinish','timeFinish'],[
            [
                2,
                'Встать',
                'чтобы упасть',
                \Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),   \Yii::$app->formatter->asTime('08:00','php: G:i'), \Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),    \Yii::$app->formatter->asTime('09:00','php: G:i')],
            [
                2,
                'Умыться','чтобы упасть',
                \Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('09:00','php: G:i'),\Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('09:15','php: G:i')],
            [
                2,
                'Погулять','чтобы упасть',
                \Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('08:00','php: G:i'),\Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('09:00','php: G:i')],
            [
                2,
                'Сделать неважное дело','чтобы упасть',
                \Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('14:00','php: G:i'),\Yii::$app->formatter->asDate('2019-06-19','php: Y-m-d'),\Yii::$app->formatter->asTime('18:00','php: G:i')],
            [
                2,
                'Неважно что, лишь бы','чтобы упасть',
                \Yii::$app->formatter->asDate('2019-06-20','php: Y-m-d'),\Yii::$app->formatter->asTime('11:00','php: G:i'),\Yii::$app->formatter->asDate('2019-06-20','php: Y-m-d'),\Yii::$app->formatter->asTime('13:05','php: G:i')],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        $this->delete('activities');
        $this->delete('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190619_074835_InsertTestData cannot be reverted.\n";

        return false;
    }
    */
}
