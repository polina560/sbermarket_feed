<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%param}}`.
 */
class m241211_085740_add_update_at_column_to_param_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%param}}', 'updated_at', $this->integer()->defaultValue(time())->comment('Время обновления'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%param}}', 'updated_at');
    }
}
