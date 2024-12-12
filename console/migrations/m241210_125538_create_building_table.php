<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%building}}`.
 */
class m241210_125538_create_building_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%building}}', [
            'id' => $this->primaryKey(),
            'id_build'=> $this->integer()->notNull()->comment('ID корпуса новостройки'),
            'fz_214' => $this->boolean()->comment('Соответствие ФЗ-214'),
            'id_complex' => $this->integer()->notNull()->comment('Комплекс'),
            'name' => $this->string()->comment('Название корпуса'),
            'floors' => $this->integer()->comment('Количество этажей'),
            'floors_ready' => $this->integer()->comment('Количество построенных этажей'),
            'building_state' => $this->string()->comment('Статус стройки'),
            'image' => $this->string()->comment('Фото расположения корпуса'),
            'ceiling_height' => $this->float()->comment('Высота потолков'),
            'passenger_lifts_count' => $this->integer()->comment('Минимальное количество пассажирских лифтов'),
            'cargo_lifts_count' => $this->integer()->comment('Минимальное количество грузовых  лифтов'),
        ]);
        $this->addForeignKey('FK_building_complex', '{{%building}}', 'id_complex', '{{%complex}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%building}}');
    }
}
