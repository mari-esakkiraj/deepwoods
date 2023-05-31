<?php

use yii\db\Migration;

/**
 * Class m230531_023808_add_cashondelivery_column_in_orders_table
 */
class m230531_023808_add_cashondelivery_column_in_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'cashondelivery', $this->tinyInteger(2)->defaultValue(0)->after('transaction_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230531_023808_add_cashondelivery_column_in_orders_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230531_023808_add_cashondelivery_column_in_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
