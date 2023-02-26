<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m230212_151951_add_mobil_number_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'mobile_number', $this->string(55)->notNull()->after('username'));
        $this->addColumn('{{%user}}', 'gst_number', $this->string(55)->after('mobile_number'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'mobil_number');
        $this->dropColumn('{{%user}}', 'gst_number');
    }
}
