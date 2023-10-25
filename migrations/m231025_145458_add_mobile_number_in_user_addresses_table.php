<?php

use yii\db\Migration;

/**
 * Class m231025_145458_add_mobile_number_in_user_addresses_table
 */
class m231025_145458_add_mobile_number_in_user_addresses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user_addresses}}', 'status', $this->smallInteger()->notNull()->defaultValue(1)->after('zipcode'));
        $this->addColumn('{{%user_addresses}}', 'mobile_number', $this->string(55)->null()->after('zipcode'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231025_145458_add_mobile_number_in_user_addresses_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231025_145458_add_mobile_number_in_user_addresses_table cannot be reverted.\n";

        return false;
    }
    */
}
