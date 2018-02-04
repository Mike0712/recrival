<?php

use yii\db\Migration;

/**
 * Handles the creation of table `clubs`.
 */
class m180202_193055_create_clubs_translation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('clubs_translation', [
            'id' => $this->primaryKey(),
            'club_id' => $this->integer(),
            'language_code' => $this->char(10),
            'club_code' => $this->char(10),
            'club_name' => $this->string()
        ]);
        $this->createIndex('i-club_translation_name', '{{%clubs_translation}}', ['club_name', 'club_code', 'language_code'], false);
        $this->addForeignKey('fk-club-translation', '{{%clubs_translation}}', 'club_id', '{{%clubs}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('clubs_translation');
    }
}
