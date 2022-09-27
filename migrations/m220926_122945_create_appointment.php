<?php

use yii\db\Migration;

/**
 * Class m220926_122945_create_appointment
 */
class m220926_122945_create_appointment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%appointment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'timezone_id' => $this->integer(),
            'week_day_id' => $this->integer(),
            'available_at' => $this->time(),
            'available_till' => $this->time(),
            'created_by' => $this->integer(). ' NULL NULL',
            'created_at' => $this->timestamp(). ' with time zone DEFAULT CURRENT_TIMESTAMP',
            'updated_by' => $this->integer(). ' NOT NULL',
            'updated_at' => $this->timestamp(). ' with time zone DEFAULT CURRENT_TIMESTAMP',
            'is_deleted' => $this->boolean(). ' DEFAULT FALSE'
        ]);
        $this->execute("ALTER TABLE appointment ADD CONSTRAINT appointment_user_id_fk FOREIGN KEY (user_id) REFERENCES public.user (id);");
        $this->execute("ALTER TABLE appointment ADD CONSTRAINT appointment_timezone_id_fk FOREIGN KEY (timezone_id) REFERENCES timezone (id);");
        $this->execute("ALTER TABLE appointment ADD CONSTRAINT appointment_week_day_id_fk FOREIGN KEY (week_day_id) REFERENCES week_day (id);");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('appointment_week_day_id_fk', 'appointment');
        $this->dropForeignKey('appointment_timezone_id_fk', 'appointment');
        $this->dropForeignKey('appointment_user_id_fk', 'appointment');
        $this->dropTable('{{%appointment}}');
    }
}
