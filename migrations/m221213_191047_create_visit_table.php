<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%visit}}`.
 */
class m221213_191047_create_visit_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%visit}}', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer()->notNull()->comment('Студент'),
            'lesson_id' => $this->integer()->notNull()->comment('Занятие'),
            'rate' => $this->integer()->comment('Оценка')
        ]);
        
        $this->addForeignKey('fk_visit_to_user', 'visit', 'student_id', 'user', 'id');
        $this->createIndex('idx_visit_to_user_id', 'visit', 'student_id');
        
        $this->addForeignKey('fk_visit_to_lesson', 'visit', 'lesson_id', 'lesson', 'id');
        $this->createIndex('idx_visit_to_lesson_id', 'visit', 'lesson_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%visit}}');
    }

}
