<?php

use yii\db\Migration;

/**
 * Class m230304_102729_add_status_column_in_cart_items_table
 */
class m230304_102729_add_status_column_in_cart_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn(
           '{{%cart_items}}',
            'created_date',
            $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP')
        );
        $sql = "ALTER TABLE `cart_items` ADD `status1` ENUM('created','updated','completed','order_placed') NULL DEFAULT NULL AFTER `created_date`";
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230304_102729_add_status_column_in_cart_items_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230304_102729_add_status_column_in_cart_items_table cannot be reverted.\n";

        return false;
    }
    */
}
