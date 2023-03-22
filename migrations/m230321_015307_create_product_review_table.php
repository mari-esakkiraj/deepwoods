<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_review}}`.
 */
class m230321_015307_create_product_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_review}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'review' => $this->string(2000),
            'review_type' => $this->tinyInteger(2)->notNull(),
            'status' => $this->tinyInteger(2)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_review}}');
    }
}
