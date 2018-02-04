<?php

use yii\db\Migration;

/**
 * Handles the creation of table `race_times`.
 */
class m180202_193657_create_race_times_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('race_times', [
            'id' => $this->primaryKey(),
            'time_start' => $this->timestamp(),
            'race_id' => $this->integer(),
        ]);

        $this->createIndex('i-race_times_name', '{{%race_times}}', ['time_start'], false);
        $this->addForeignKey('fk-race-times-race', '{{%race_times}}', 'race_id', '{{%races}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('race_times');
    }
}
