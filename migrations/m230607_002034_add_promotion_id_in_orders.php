<?php

use yii\db\Migration;

/**
 * Class m230607_002034_add_promotion_id_in_orders
 */
class m230607_002034_add_promotion_id_in_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'promotion_id', $this->integer()->defaultValue(0)->after('product_price'));
        $this->addColumn('{{%orders}}', 'sgst', $this->decimal(10,2)->defaultValue(0)->after('gst'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230607_002034_add_promotion_id_in_orders cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230607_002034_add_promotion_id_in_orders cannot be reverted.\n";

        return false;
    }
    */
}
