<?php

use yii\db\Migration;

/**
 * Class m230328_014706_add_type_column_in_user_addresses_table
 */
class m230328_014706_add_type_column_in_user_addresses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "ALTER TABLE `user_addresses` 
        ADD COLUMN `type` ENUM('shipping', 'billing') NULL DEFAULT 'shipping' AFTER `address`,
        CHANGE COLUMN `address` `address` TEXT NOT NULL ;";
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230328_014706_add_type_column_in_user_addresses_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230328_014706_add_type_column_in_user_addresses_table cannot be reverted.\n";

        return false;
    }
    */
}
