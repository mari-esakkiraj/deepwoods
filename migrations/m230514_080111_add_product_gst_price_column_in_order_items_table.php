<?php

use yii\db\Migration;

/**
 * Class m230514_080111_add_product_gst_price_column_in_order_items_table
 */
class m230514_080111_add_product_gst_price_column_in_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%order_items}}', 'product_gst_price', $this->decimal(10,2)->null()->defaultValue(0)->after('unit_price'));
        $this->addColumn('{{%orders}}', 'products_gst_price', $this->decimal(10,2)->null()->defaultValue(0)->after('gst'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%order_items}}', 'product_gst_price');
        $this->dropColumn('{{%orders}}', 'products_gst_price');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230514_080111_add_product_gst_price_column_in_order_items_table cannot be reverted.\n";

        return false;
    }
    */
}
