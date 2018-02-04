<?php

use yii\db\Migration;

/**
 * Handles the creation of table `clubs`.
 */
class m180202_193053_create_clubs_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('clubs', [
            'id' => $this->primaryKey(),
            'logo' => $this->char(255)->null(),
            'alias' => $this->string(),
            'place_id' => $this->integer()->null(),
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->timestamp()->null(),
            'deleted' => $this->boolean()->defaultValue(false)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('clubs');
    }
}
