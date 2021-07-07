<?php

use yii\db\Migration;

/**
 * Class m190619_074153_AddFKIndexes
 */
class m190619_074153_AddFKIndexes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx-user_activity',
            'activities',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_id-activity_id',
            'activities',
            'user_id',
            'users',
            'id'
        );

        $this->createIndex('idx-user_files-activity_id',
        'userFiles',
        'activity_id'
        );

        $this->createIndex(
        'idx-file_id-user_id',
        'userFiles',
        'user_id'
        );
        
        $this->addForeignKey(
            'fk-file_id-activity_id',
            'userFiles',
            'activity_id',
            'activities',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190619_074153_AddFKIndexes cannot be reverted.\n";

        return false;
    }
    */
}
