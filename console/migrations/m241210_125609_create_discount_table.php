<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discount}}`.
 */
class m241210_125609_create_discount_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%discount}}', [
            'id' => $this->primaryKey(),
            'id_complex' => $this->integer()->notNull()->comment('Комплекс'),
            'name' => $this->string()->notNull()->comment('Название акции'),
            'description' => $this->string(3000)->notNull()->comment('Описание акции'),
            'image' => $this->string()->comment('Изображение'),
        ]);

        $this->addForeignKey('FK_discount_complex', '{{%discount}}', 'id_complex', '{{%complex}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%discount}}');
    }
}
