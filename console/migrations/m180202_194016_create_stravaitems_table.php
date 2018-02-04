<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stravaitems`.
 */
class m180202_194016_create_stravaitems_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('stravaitems', [
            'id' => $this->primaryKey(),
            'strava_id' => $this->integer(),
            'access_token' => $this->string()->unique(),
            'register' => $this->boolean(),
            'user_id' => $this->integer()->null(),
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->timestamp()->null(),
            'deleted' => $this->boolean()->defaultValue(false)
        ]);
        $this->createIndex('i-stravaitems_name', '{{%stravaitems}}', ['strava_id', 'access_token'], false);
        $this->addForeignKey('fk-strava-user', '{{%stravaitems}}', 'user_id', '{{%users}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('stravaitems');
    }
}
