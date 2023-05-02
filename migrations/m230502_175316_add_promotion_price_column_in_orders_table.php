<?php

use yii\db\Migration;

/**
 * Class m230502_175316_add_promotion_price_column_in_orders_table
 */
class m230502_175316_add_promotion_price_column_in_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "ALTER TABLE `orders` 
        ADD COLUMN `promotion_price` DECIMAL(10,2) NULL AFTER `product_price`";
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230502_175316_add_promotion_price_column_in_orders_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230502_175316_add_promotion_price_column_in_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
