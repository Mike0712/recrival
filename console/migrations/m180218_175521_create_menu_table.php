<?php

use yii\db\Migration;

/**
 * Handles the creation of table `frontend_menu`.
 */
class m180218_175521_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu', [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
            'position' => $this->string(),
            'parent_id' => $this->integer(),
            'type' => $this->integer(),
            'block_type' => $this->integer(),
            'application' => $this->integer(),
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->timestamp()->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}
