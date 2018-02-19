<?php

use yii\db\Migration;

/**
 * Handles the creation of table `frontend_menu_translation`.
 */
class m180218_180105_create_menu_translation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu_translation', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'language_code' => $this->char(10),
            'menu_id' => $this->integer(),
        ]);
        $this->createIndex('i-menu_translation_name', '{{%menu_translation}}', ['title', 'language_code'], false);
        $this->addForeignKey('fk-menu-translation', '{{%menu_translation}}', 'menu_id', '{{%menu}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu_translation');
    }
}
