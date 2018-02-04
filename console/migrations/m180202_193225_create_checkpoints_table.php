<?php

use yii\db\Migration;

/**
 * Handles the creation of table `checkpoints`.
 */
class m180202_193225_create_checkpoints_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('checkpoints', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'value' => $this->float(),
            'lattitude' => $this->float(),
            'longditude' => $this->float(),
            'track_id' => $this->integer(),
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->timestamp()->null(),
            'deleted' => $this->boolean()->defaultValue(false)
        ]);

        $this->createIndex('i-checkpoints_name', '{{%checkpoints}}', ['name', 'value', 'lattitude', 'longditude'], false);
        $this->addForeignKey('fk-checkpoint-track', '{{%checkpoints}}', 'track_id', '{{%tracks}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('checkpoints');
    }
}
