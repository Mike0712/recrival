<?php

use yii\db\Migration;

/**
 * Handles the creation of table `results`.
 */
class m180202_193230_create_results_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('results', [
            'id' => $this->primaryKey(),
            'total_time' => $this->timestamp(),
            'user_id' => $this->integer(),
            'checkpoint_id' => $this->integer(),
        ]);

        $this->createIndex('i-results_name', '{{%results}}', ['total_time'], false);
        $this->addForeignKey('fk-result-user', '{{%results}}', 'user_id', '{{%users}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-result-checkpoint', '{{%results}}', 'checkpoint_id', '{{%checkpoints}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('results');
    }
}
