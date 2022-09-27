<?php

use yii\db\Migration;

/**
 * Class m220927_043928_appointment_booking
 */
class m220927_043928_appointment_booking extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%appointment_booking}}', [
            'id' => $this->primaryKey(),
            'appointment_id' => $this->integer(),
            'from'       => $this->time(),
            'to'         => $this->time(),
            'created_by' => $this->integer(). ' NULL NULL',
            'created_at' => $this->timestamp(). ' with time zone DEFAULT CURRENT_TIMESTAMP',
            'updated_by' => $this->integer(). ' NOT NULL',
            'updated_at' => $this->timestamp(). ' with time zone DEFAULT CURRENT_TIMESTAMP',
            'is_deleted' => $this->boolean(). ' DEFAULT FALSE'
        ]);
        $this->execute("ALTER TABLE appointment_booking ADD CONSTRAINT appointment_booking_appointment_id_fk FOREIGN KEY (appointment_id) REFERENCES appointment(id);");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('appointment_booking_appointment_id_fk', 'appointment');
        $this->dropTable('{{%appointment_booking}}');
    }
}
