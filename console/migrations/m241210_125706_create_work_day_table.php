<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_day}}`.
 */
class m241210_125706_create_work_day_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%work_day}}', [
            'id' => $this->primaryKey(),
            'id_sale_info' => $this->integer()->notNull()->comment('Отдел продаж'),
            'day' => $this->integer()->notNull()->comment('День недели'),
            'open_at' => $this->integer()->notNull()->comment('Время открытия'),
            'close_at' => $this->integer()->notNull()->comment('Время закртыия'),
        ]);

        $this->addForeignKey('FK_work_day_sale_info', '{{%work_day}}', 'id_sale_info', '{{%sale_info}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%work_day}}');
    }
}
