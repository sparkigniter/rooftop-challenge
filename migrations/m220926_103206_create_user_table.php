<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220926_103206_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name'  => $this->string(),
            'created_by' => $this->integer(). ' NULL NULL',
            'created_at' => $this->timestamp(). ' with time zone DEFAULT CURRENT_TIMESTAMP',
            'updated_by' => $this->integer(). ' NOT NULL',
            'updated_at' => $this->timestamp(). ' with time zone DEFAULT CURRENT_TIMESTAMP',
            'is_deleted' => $this->boolean(). ' DEFAULT FALSE'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
