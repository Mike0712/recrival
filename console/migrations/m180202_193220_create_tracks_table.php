<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tracks`.
 */
class m180202_193220_create_tracks_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tracks', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'distance' => $this->float(),
            'polyline' => $this->text(),
            'user_id' => $this->integer(),
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->timestamp()->null(),
            'deleted' => $this->boolean()->defaultValue(false),
        ]);

        $this->createIndex('i-tracks_name', '{{%tracks}}', ['title', 'distance'], false);
        $this->addForeignKey('fk-track-user', '{{%tracks}}', 'user_id', '{{%users}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tracks');
    }
}
