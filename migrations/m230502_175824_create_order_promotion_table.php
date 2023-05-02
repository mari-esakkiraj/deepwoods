<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_promotion}}`.
 */
class m230502_175824_create_order_promotion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_promotion}}', [
            'id' => $this->primaryKey(),
            'promotion_id' => $this->integer(11)->notNull(),
            'promotion_code' => $this->string(255)->notNull(),
            'unit_price' => $this->decimal(10,2)->notNull(),
            'order_id' => $this->integer(11)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_promotion}}');
    }
}
