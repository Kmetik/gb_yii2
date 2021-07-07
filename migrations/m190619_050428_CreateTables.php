<?php

use yii\db\Migration;

/**
 * Class m190619_050428_CreateTables
 */
class m190619_050428_CreateTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->createTable('users',[
            'id'=>$this->primaryKey(),
            'email'=>$this->string(55)->notNull()->unique(),
            'password_hash'=>$this->string(300)->notNull(),
            'role'=>$this->integer()->defaultValue(0),
            'auth_token'=>$this->string(300),
            'auth_key'=>$this->string(300),
            'created_at'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('activities',[
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'title'=>$this->string(150)->notNull(),
            'description'=>$this->text(),
            'dateStart'=>$this->date()->notNull(),
            'timeStart'=>$this->time()->notNull(),
            'dateFinish'=>$this->date()->notNull(),
            'timeFinish'=>$this->time(),
            'isBlocked'=>$this->boolean()->defaultValue(0),
            'isRepeat'=>$this->boolean()->defaultValue(0),
            'useNotification'=>$this->boolean()->defaultValue(0),
            'repeatType'=>$this->string(),
            'userFiles'=>$this->integer(),
            'active'=>$this->boolean()->notNull()->defaultValue(1),
            'created_at'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
            ]);

        $this->createTable('userFiles',[
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'activity_id'=>$this->integer()->notNull(),
            'fileURL'=>$this->string()->notNull()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-user_id-activity_id',
            'activities'
        );
        
        $this->dropForeignKey(
            'fk-file_id-activity_id',
            'userFiles'
        );

        $this->dropIndex(
            'idx-user_activity',
            'activities'
        );

        $this->dropIndex(
            'idx-user_files-activity_id',
            'userFiles'
        );
        $this->dropIndex(
            'idx-file_id-user_id',
            'userFiles'
        );
        
        $this->dropTable('users');
        $this->dropTable('activities');
        $this->dropTable('userFiles');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190619_050428_CreateTables cannot be reverted.\n";

        return false;
    }
    */
}
