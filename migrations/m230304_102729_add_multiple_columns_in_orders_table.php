<?php

use yii\db\Migration;

/**
 * Class m230304_102729_add_multiple_column_in_orders_table
 */
class m230304_102729_add_multiple_column_in_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        
        $sql = "ALTER TABLE `orders` ADD COLUMN `customer_id` INT NULL AFTER `id`, ADD COLUMN `billing_address_id` INT NULL AFTER `paypal_order_id`, ADD COLUMN `shipping_address_id` INT NULL AFTER `billing_address_id`, ADD COLUMN `phone` VARCHAR(50) NULL AFTER `customer_id`";
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m230304_102729_add_multiple_column_in_orders_table cannot be reverted.\n";

        return false;
    }

   
}
