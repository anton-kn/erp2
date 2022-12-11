<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m221208_193850_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'surname' => $this->string(100)->notNull()->comment('Фамилия'),
            'firstname' => $this->string(100)->notNull()->comment('Имя'),
            'patronymic' => $this->string(100)->notNull()->comment('Отчество'),
            'email' => $this->string(100)->notNull()->comment('Почта'),
            'phone' => $this->bigInteger()->comment('Телефон'),
            'password_hash' => $this->string()->notNull()->comment('Пароль'),
            'comment' => $this->string(1000)->comment('Описание о пользователе'),
            'type'=> $this->smallInteger()->notNull()->comment('Пользователь'),
            'is_admin' => $this->boolean()->defaultValue(false)->notNull()->comment('Администратор'),
            
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
