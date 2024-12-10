<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%description_main}}`.
 */
class m241210_125636_create_description_main_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%description_main}}', [
            'id' => $this->primaryKey(),
            'id_complex' => $this->integer()->notNull()->comment('Комплекс'),
            'title' => $this->string(500)->comment('Заголовок'),
            'text' => $this->string(3000)->notNull()->comment('Описание'),
        ]);

        $this->addForeignKey('FK_description_complex', '{{%description_main}}', 'id_complex', '{{%complex}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%description_main}}');
    }
}
