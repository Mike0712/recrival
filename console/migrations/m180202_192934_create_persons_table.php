<?php

use yii\db\Migration;

/**
 * Handles the creation of table `persons`.
 */
class m180202_192934_create_persons_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("
            CREATE TYPE gender
            AS ENUM (
                'm',
                'f'
            )
        ");

        $this->createTable('persons', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'gender' => 'gender',
            'birthday' => $this->date(),
            'user_id' =>$this->integer(),
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->timestamp()->null(),
            'deleted' => $this->boolean()->defaultValue(false)
        ]);

        $this->createIndex('i-persons_user', '{{%persons}}', ['user_id',], true);
        $this->createIndex('i-persons_name', '{{%persons}}', ['first_name', 'last_name'], false);
        $this->addForeignKey('fk-person-user', '{{%persons}}', 'user_id', '{{%users}}', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute("DROP TYPE gender;");
        $this->dropTable('persons');
    }
}
