<?php

use yii\db\Migration;

/**
 * Class m230321_154316_alter_promotion_table
 */
class m230321_154316_alter_promotion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('promotion', 'image');
        $this->addColumn('{{%promotion}}', 'discount_type', $this->string(100)->null()->after('price'));
        $this->addColumn('{{%promotion}}', 'promotion_type', $this->string(100)->null()->after('discount_type'));
        $this->addColumn('{{%promotion}}', 'start_date', $this->string(100)->null()->after('promotion_type'));
        $this->addColumn('{{%promotion}}', 'end_date', $this->string(100)->null()->after('start_date'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230321_154316_alter_promotion_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230321_154316_alter_promotion_table cannot be reverted.\n";

        return false;
    }
    */
}
