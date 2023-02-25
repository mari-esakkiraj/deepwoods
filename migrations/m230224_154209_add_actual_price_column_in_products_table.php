<?php

use yii\db\Migration;

/**
 * Class m230224_154209_add_actual_price_column_in_products_table
 */
class m230224_154209_add_actual_price_column_in_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230224_154209_add_actual_price_column_in_products_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230224_154209_add_actual_price_column_in_products_table cannot be reverted.\n";

        return false;
    }
    */
}
