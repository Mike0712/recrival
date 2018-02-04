<?php

use yii\db\Migration;

/**
 * Handles the creation of table `events`.
 */
class m180202_193170_create_events_translation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('events_translation', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer(),
            'language_code' => $this->char(10),
            'event_name' => $this->text()
        ]);

        $this->createIndex('i-events_translation_name', '{{%events_translation}}', ['event_name'], false);
        $this->addForeignKey('fk-event-translation', '{{%events_translation}}', 'event_id', '{{%events}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('events_translation');
    }
}
