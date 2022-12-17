<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lesson}}`.
 */
class m221217_204501_create_lesson_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lesson}}', [
            'id' => $this->primaryKey(),
            'lecture_id' => $this->integer()->notNull()->comment('Лекции'),
            'date' => $this->date()->notNull()->comment('Дата проведения'),
            'time_start' => $this->time()->notNull()->comment('Время начала'),
            'time_end' => $this->time()->notNull()->comment('Время конца'),
            'place_id' => $this->integer()->notNull()->comment('Место проведения')
        ]);
        
        $this->addForeignKey('fk_lesson_to_place', 'lesson', 'place_id', 'place', 'id');
        $this->createIndex('idx_lesson_to_place_id', 'lesson', 'place_id');
        
        $this->addForeignKey('fk_lesson_to_lecture', 'lesson', 'lecture_id', 'lecture', 'id');
        $this->createIndex('idx_lesson_to_lecture_id', 'lesson', 'lecture_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lesson}}');
    }
}
