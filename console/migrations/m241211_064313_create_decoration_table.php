<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%decoration}}`.
 */
class m241211_064313_create_decoration_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%decoration}}', [
            'id' => $this->primaryKey(),
            'id_complex' => $this->integer()->notNull()->comment('Комплекс'),
            'title' => $this->string()->notNull()->comment('Имя типа отделки'),
            'text' => $this->string()->notNull()->comment('Описание отделки'),
        ]);

        $this->addForeignKey('FK_decoration_complex', '{{%decoration}}', 'id_complex', '{{%complex}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%decoration}}');
    }
}
