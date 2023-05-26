<?php

use yii\db\Migration;

/**
 * Class m230526_175840_add_phoneno_column_in_contactus_table
 */
class m230526_175840_add_phoneno_column_in_contactus_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%contact_us}}', 'phone_number', $this->string()->null()->after('email'));
        $this->addColumn('{{%settings}}', 'fssai_number', $this->string()->null()->after('gst_number'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230526_175840_add_phoneno_column_in_contactus_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230526_175840_add_phoneno_column_in_contactus_table cannot be reverted.\n";

        return false;
    }
    */
}
