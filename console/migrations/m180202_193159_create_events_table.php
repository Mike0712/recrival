<?php

use yii\db\Migration;

/**
 * Handles the creation of table `events`.
 */
class m180202_193159_create_events_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('events', [
            'id' => $this->primaryKey(),
            'date_start' => $this->date(),
            'date_finish' => $this->date()->null(),
            'org_id' => $this->integer(),
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->timestamp()->null(),
            'deleted' => $this->boolean()->defaultValue(false)
        ]);

        $this->createIndex('i-events_name', '{{%events}}', ['date_start', 'date_finish'], false);
        $this->addForeignKey('fk-event-organizer', '{{%events}}', 'org_id', '{{%users}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('events');
    }
}
