<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%xml_file}}`.
 */
class m241210_125536_create_xml_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%xml_file}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string()->notNull()->comment('Ключ'),
            'xml' => $this->text()->comment('XML-файл'),
            'updated_at' => $this->integer()->comment('Время изменения'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%xml_file}}');
    }
}
