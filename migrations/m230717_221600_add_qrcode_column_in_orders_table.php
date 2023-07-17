<?php

use yii\db\Migration;

/**
 * Class m230717_221600_add_qrcode_column_in_orders_table
 */
class m230717_221600_add_qrcode_column_in_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'qrcode', $this->tinyInteger(2)->defaultValue(0)->after('transaction_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230717_221600_add_qrcode_column_in_orders_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230717_221600_add_qrcode_column_in_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
