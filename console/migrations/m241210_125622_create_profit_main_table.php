<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profit_main}}`.
 */
class m241210_125622_create_profit_main_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%profit_main}}', [
            'id' => $this->primaryKey(),
            'id_complex' => $this->integer()->notNull()->comment('Комплекс'),
            'title' => $this->string()->notNull()->comment('Заголовок'),
            'text' => $this->string(500)->notNull()->comment('Описание'),
            'image' => $this->string()->notNull()->comment('Изображение'),
        ]);

        $this->addForeignKey('FK_profit_complex', '{{%profit_main}}', 'id_complex', '{{%complex}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%profit_main}}');
    }
}
