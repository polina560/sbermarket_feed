<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sale_info}}`.
 */
class m241210_125654_create_sale_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%sale_info}}', [
            'id' => $this->primaryKey(),
            'id_complex' => $this->integer()->notNull()->comment('Комплекс'),
            'sales_phone' => $this->string()->notNull()->comment('Телефон отдела продаж'),
            'address' => $this->string()->comment('Адрес отдела продаж'),
            'sales_latitude' => $this->float()->comment('Широта отдела продаж'),
            'sales_longitude' => $this->float()->comment('Долгота отдела продаж'),
            'timezone' => $this->string()->notNull()->comment('Часовой пояс по Гринвичу'),
        ]);
        $this->addForeignKey('FK_sale_info_complex', '{{%sale_info}}', 'id_complex', '{{%complex}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%sale_info}}');
    }
}
