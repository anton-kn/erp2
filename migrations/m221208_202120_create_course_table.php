<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%course}}`.
 */
class m221208_202120_create_course_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%course}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название'),
            'date_start' => $this->date()->comment('Дата начала'),
            'date_end' => $this->date()->comment('Дата конца'),
            'status' => $this->integer()->notNull()->comment('Статус курса'),
            'teacher_id' => $this->integer()->notNull()->comment('Преподаватель'),
            'rate_med' => $this->float()->comment('Средняя оценка за курс')
        ]);

        $this->addForeignKey('fk_person_id_to_course', 'course', 'teacher_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_course_teacher_id', 'course', 'teacher_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%course}}');
    }
}
