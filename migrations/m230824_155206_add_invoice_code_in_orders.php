<?php

use yii\db\Migration;

/**
 * Class m230824_155206_add_invoice_code_in_orders
 */
class m230824_155206_add_invoice_code_in_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'invoice_code', $this->string()->null()->after('order_code'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230824_155206_add_invoice_code_in_orders cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230824_155206_add_invoice_code_in_orders cannot be reverted.\n";

        return false;
    }
    */
}
