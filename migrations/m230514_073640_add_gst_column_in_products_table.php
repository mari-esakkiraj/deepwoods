<?php

use yii\db\Migration;

/**
 * Class m230514_073640_add_gst_column_in_products_table
 */
class m230514_073640_add_gst_column_in_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%products}}', 'gst', $this->decimal(10,2)->null()->after('quantity'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%products}}', 'gst');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230514_073640_add_gst_column_in_products_table cannot be reverted.\n";

        return false;
    }
    */
}
