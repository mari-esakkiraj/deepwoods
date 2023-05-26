<?php

use yii\db\Migration;

/**
 * Class m230526_171908_add_order_code_column_in_orders_table
 */
class m230526_171908_add_order_code_column_in_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'order_code', $this->string()->null()->after('id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230526_171908_add_order_code_column_in_orders_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230526_171908_add_order_code_column_in_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
