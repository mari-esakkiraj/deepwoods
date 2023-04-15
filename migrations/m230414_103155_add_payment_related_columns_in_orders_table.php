<?php

use yii\db\Migration;

/**
 * Class m230414_103155_add_payment_related_columns_in_orders_table
 */
class m230414_103155_add_payment_related_columns_in_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "ALTER TABLE `orders` 
        ADD COLUMN `product_price` DECIMAL(10,2) NOT NULL AFTER `total_price`,
        ADD COLUMN `gst` DECIMAL(10,2) NOT NULL AFTER `product_price`,
        ADD COLUMN `freight_charges` DECIMAL(10,2) NOT NULL AFTER `gst`";
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230414_103155_add_payment_related_columns_in_orders_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230414_103155_add_payment_related_columns_in_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
