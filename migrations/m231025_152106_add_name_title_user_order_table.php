<?php

use yii\db\Migration;

/**
 * Class m231025_152106_add_name_title_user_order_table
 */
class m231025_152106_add_name_title_user_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'name_title', $this->string(55)->null()->after('status'));
        $this->addColumn('{{%user}}', 'name_title', $this->string(55)->null()->after('id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231025_152106_add_name_title_user_order_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231025_152106_add_name_title_user_order_table cannot be reverted.\n";

        return false;
    }
    */
}
