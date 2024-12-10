<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%developer}}`.
 */
class m241210_125718_create_developer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%developer}}', [
            'id' => $this->primaryKey(),
            'id_complex' => $this->integer()->notNull()->comment('Комплекс'),
            'id_developer' => $this->integer()->notNull()->comment('ID застройщика'),
            'name' => $this->string()->notNull()->comment('Название застройщика'),
            'site' => $this->string()->comment('Ссылка на сайт'),
            'logo' => $this->string()->comment('Ссылка на логотип'),
        ]);
        $this->addForeignKey('FK_developer_complex', '{{%developer}}', 'id_complex', '{{%complex}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%developer}}');
    }
}
