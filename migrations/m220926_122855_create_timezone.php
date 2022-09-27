<?php

use yii\db\Migration;

/**
 * Class m220926_122855_create_timezone
 */
class m220926_122855_create_timezone extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%timezone}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
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
        $this->dropTable('{{%timezone}}');
    }
}
