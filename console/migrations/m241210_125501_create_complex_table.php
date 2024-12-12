<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%complex}}`.
 */
class m241210_125501_create_complex_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%complex}}', [
            'id' => 'int NOT NULL',
//            'id_complex' => $this->integer()->notNull()->comment('ID Комплекса'),
            'name' => $this->string()->notNull()->comment('Название ЖК'),
            'latitude' => $this->float()->notNull()->comment('Географическая широта ЖК'),
            'longitude' => $this->float()->notNull()->comment('Географическая долгота ЖК'),
            'address' => $this->string()->notNull()->comment('Название ЖК'),
            'PRIMARY KEY (id)'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%complex}}');
    }
}
