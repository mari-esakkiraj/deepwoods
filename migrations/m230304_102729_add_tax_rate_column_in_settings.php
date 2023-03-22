<?php

use yii\db\Migration;

/**
 * Class m230304_102729_add_status_column_in_settings_table
 */
class m230304_102729_add_tax_rate_column_in_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%settings}}', 'freight_charges', $this->integer(10)->after('gst'));
        $this->addColumn('{{%settings}}', 'qty_alert', $this->integer(10)->after('freight_charges'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m230304_102729_add_status_column_in_settings_table cannot be reverted.\n";

        return false;
    }
}
