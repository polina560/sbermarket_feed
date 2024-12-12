<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video}}`.
 */
class m241211_064402_create_video_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%video}}', [
            'id' => $this->primaryKey(),
            'id_complex' => $this->integer()->notNull()->comment('Комплекс'),
            'type' => $this->string()->notNull()->comment('Тип ссылки'),
            'url' => $this->string()->notNull()->comment('Ссылка'),
        ]);

        $this->addForeignKey('FK_video_complex', '{{%video}}', 'id_complex', '{{%complex}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%video}}');
    }
}
