<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%infrastructure}}`.
 */
class m241211_064345_create_infrastructure_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%infrastructure}}', [
            'id' => $this->primaryKey(),
            'id_complex' => $this->integer()->notNull()->comment('Комплекс'),
            'parking' => $this->string()->comment('Парковка'),
            'security' => $this->boolean()->comment('Охрана'),
            'fenced_area' => $this->boolean()->comment('Огороженная территория'),
            'sports_ground' => $this->boolean()->comment('Спортивная площадка'),
            'playground' => $this->boolean()->comment('Детская площадка'),
            'school' => $this->boolean()->comment('Школа'),
            'kindergarten' => $this->boolean()->comment('Детский сад'),

        ]);

        $this->addForeignKey('FK_infrastructure_complex', '{{%infrastructure}}', 'id_complex', '{{%complex}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%infrastructure}}');
    }
}
