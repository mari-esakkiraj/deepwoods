<?php

use yii\db\Migration;

/**
 * Class m230324_134351_alter_table_promotion
 */
class m230324_134351_alter_table_promotion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "ALTER TABLE `promotion` CHANGE `discount_type` `discount_type` ENUM('Flat','Percentage') CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `promotion_type` `promotion_type` ENUM('coupon','promotion') CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `status` `status` ENUM('active','inactive') CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL,CHANGE `start_date` `start_date` DATE NULL, CHANGE `end_date` `end_date` DATE NULL";
        Yii::$app->db->createCommand($sql)->execute();
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230324_134351_alter_table_promotion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230324_134351_alter_table_promotion cannot be reverted.\n";

        return false;
    }
    */
}
