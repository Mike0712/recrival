<?php

use yii\db\Migration;

/**
 * Class m180202_193058_pivot_person_club_table
 */

class m180202_193058_pivot_person_club_table extends Migration
{
    public function up()
    {
        $this->createTable('person_club', [
            'id' => $this->primaryKey(),
            'club_id' => $this->integer(),
            'person_id' => $this->integer(),
        ]);
        $this->addForeignKey('fk-person-club-club', '{{%person_club}}', 'club_id', '{{%clubs}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-person-club-person', '{{%person_club}}', 'person_id', '{{%persons}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('person_club');
    }
}
