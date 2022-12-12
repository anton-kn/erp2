<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%course_student}}`.
 */
class m221210_141238_create_course_student_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%course_student}}', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer()->notNull()->comment('Курс'),
            'student_id' => $this->integer()->notNull()->comment('Студент')
        ]);
        
        $this->addForeignKey('fk_course_student_to_user', 'course_student', 'student_id', 'user', 'id');
        $this->createIndex('idx_course_student_student_id', 'course_student', 'student_id');
        
        $this->addForeignKey('fk_course_student_to_course', 'course_student', 'course_id', 'course', 'id');
        $this->createIndex('idx_course_student_to_course_id', 'course_student', 'course_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%course_student}}');
    }
}
