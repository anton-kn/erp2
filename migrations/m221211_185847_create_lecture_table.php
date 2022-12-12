<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lecture}}`.
 */
class m221211_185847_create_lecture_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lecture}}', [
            'id' => $this->primaryKey(),
            'num' => $this->integer()->notNull()->comment('Порядковый номер'),
            'name' => $this->string(100)->notNull()->comment('Тема лекции'),
            'course_id' => $this->integer()->notNull()->comment('Курс'),
            'rate' => $this->double()->comment('Оценка')
        ]);
        
        $this->addForeignKey('fk_lecture_to_course', 'lecture', 'course_id', 'course', 'id');
        $this->createIndex('idx_lecture_to_course_id', 'lecture', 'course_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lecture}}');
    }
}
