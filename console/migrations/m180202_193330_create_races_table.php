<?php

use yii\db\Migration;

/**
 * Handles the creation of table `races`.
 */
class m180202_193330_create_races_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('races', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'event_id' => $this->integer(),
            'track_id' => $this->integer(),
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->timestamp()->null(),
            'deleted' => $this->boolean()->defaultValue(false)
        ]);
        $this->createIndex('i-races_name', '{{%races}}', ['title'], false);
        $this->addForeignKey('fk-race-event', '{{%races}}', 'event_id', '{{%events}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-race-track', '{{%races}}', 'track_id', '{{%tracks}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('races');
    }
}
