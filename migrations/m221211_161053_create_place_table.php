<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%place}}`.
 */
class m221211_161053_create_place_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%place}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string(200)->notNull()->comment('Адрес'),
            'cabinet' => $this->string(7)->notNull()->comment('Кабинет')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%place}}');
    }

}
