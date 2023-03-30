<?php

use yii\db\Migration;

/**
 * Class m230328_145253_alter_table_user
 */
class m230328_145253_alter_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'company', $this->string(100)->after('gst_number'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230328_145253_alter_table_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230328_145253_alter_table_user cannot be reverted.\n";

        return false;
    }
    */
}
