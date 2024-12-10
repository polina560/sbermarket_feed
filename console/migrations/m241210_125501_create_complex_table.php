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
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название ЖК'),
            'latitude' => $this->float()->notNull()->comment('Географическая широта ЖК'),
            'longitude' => $this->float()->notNull()->comment('Географическая долгота ЖК'),
            'address' => $this->string()->notNull()->comment('Название ЖК'),
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
