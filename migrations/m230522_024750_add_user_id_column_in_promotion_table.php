<?php

use yii\db\Migration;

/**
 * Class m230522_024750_add_user_id_column_in_promotion_table
 */
class m230522_024750_add_user_id_column_in_promotion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%promotion}}', 'user_id', $this->integer(11)->null()->defaultValue(0)->after('id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230522_024750_add_user_id_column_in_promotion_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230522_024750_add_user_id_column_in_promotion_table cannot be reverted.\n";

        return false;
    }
    */
}
