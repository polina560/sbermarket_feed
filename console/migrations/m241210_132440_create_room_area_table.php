<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room_area}}`.
 */
class m241210_132440_create_room_area_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%room_area}}', [
            'id' => $this->primaryKey(),
            'id_flat' => $this->integer()->notNull()->comment('Комната'),
            'area' => $this->float()->notNull()->comment('Площадь жилой комнаты'),
        ]);

        $this->addForeignKey('FK_room_area', '{{%room_area}}', 'id_flat', '{{%flat}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%room_area}}');
    }
}
