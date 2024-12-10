<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%flat}}`.
 */
class m241210_125551_create_flat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%flat}}', [
            'id' => $this->primaryKey(),
            'flat_id' => $this->integer()->notNull()->comment('ID квартиры'),
            'id_building' => $this->integer()->notNull()->comment('Строение'),
            'apartment' => $this->integer()->notNull()->comment('Номер квартиры'),
            'floor' => $this->integer()->notNull()->comment('Этаж'),
            'room' => $this->integer()->notNull()->comment('Количество комнат'),
            'ceiling_height' => $this->integer()->comment('Высота потолков в квартире'),
            'description' => $this->string()->comment('Характеристики квартиры'),
            'balcony' => $this->integer()->comment('Наличие балкона'),
            'renovation' => $this->integer()->comment('Качество отделки'),
            'price' => $this->integer()->notNull()->comment('Цена в рублях'),
            'area' => $this->float()->notNull()->comment('Общая площадь'),
            'living_area' => $this->float()->notNull()->comment('Жилая площадь'),
            'kitchen_area' => $this->float()->notNull()->comment('Площадь кухни'),
            'window_view' => $this->integer()->comment('Вид из окон'),
            'bathroom' => $this->integer()->comment('Санузел'),
            'layout_type' => $this->string()->comment('Тип планировки'),
            'housing_type' => $this->integer()->notNull()->comment('Тип жилья'),
        ]);
        $this->addForeignKey('FK_flat_building', '{{%flat}}', 'id_building', '{{%building}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%flat}}');
    }
}
