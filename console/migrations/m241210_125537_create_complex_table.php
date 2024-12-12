<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%complex}}`.
 */
class m241210_125537_create_complex_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%complex}}', [
            'id' => $this->primaryKey(),
            'id_complex' => $this->integer()->notNull()->comment('ID Комплекса'),
            'name' => $this->string()->notNull()->comment('Название ЖК'),
            'latitude' => $this->float()->notNull()->comment('Географическая широта ЖК'),
            'longitude' => $this->float()->notNull()->comment('Географическая долгота ЖК'),
            'address' => $this->string()->notNull()->comment('Название ЖК'),
            'id_feed' => $this->integer()->notNull()->comment('ID XML-файла'),
        ]);

        $this->addForeignKey('FK_complex_xml', '{{%complex}}', 'id_feed', '{{%xml_file}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%complex}}');
    }
}
