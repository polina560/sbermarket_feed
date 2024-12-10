<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%plan}}`.
 */
class m241210_131742_create_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%plan}}', [
            'id' => $this->primaryKey(),
            'id_flat' => $this->integer()->notNull()->comment('Комната'),
            'plan' => $this->string()->notNull()->comment('Фото квартиры'),
        ]);

        $this->addForeignKey('FK_room_plan', '{{%plan}}', 'id_flat', '{{%flat}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%plan}}');
    }
}
