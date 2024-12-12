<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m241211_121943_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'id_complex' => $this->integer()->notNull()->comment('Комплекс'),
            'id_decoration' => $this->integer()->comment('Отделка'),
            'image' => $this->text()->notNull()->comment('Ссылка на изображение'),

        ]);

        $this->addForeignKey('FK_image_complex', '{{%image}}', 'id_complex', '{{%complex}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_image_decoration', '{{%image}}', 'id_decoration', '{{%decoration}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
