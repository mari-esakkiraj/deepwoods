<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%products}}`.
 */
class m230321_020539_add_additonal_columns_to_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%products}}', 'gst_no', $this->string(100)->null()->after('quantity'));
        $this->addColumn('{{%products}}', 'hsn_sac', $this->string(100)->null()->after('gst_no'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%products}}', 'gst_no');
        $this->dropColumn('{{%products}}', 'hsn_sac');
    }
}
