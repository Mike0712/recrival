<?php

use yii\db\Migration;

/**
 * Class m180202_193058_pivot_person_club_table
 */

class m180202_193222_pivot_event_track_table extends Migration
{
    public function up()
    {
        $this->createTable('event_track', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer(),
            'track_id' => $this->integer(),
        ]);
        $this->addForeignKey('fk-event-track-event', '{{%event_track}}', 'event_id', '{{%events}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-event-track-track', '{{%event_track}}', 'track_id', '{{%tracks}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('person_club');
    }
}
