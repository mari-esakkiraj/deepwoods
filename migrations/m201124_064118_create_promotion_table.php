<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%promotion}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m201124_064118_create_promotion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%promotion}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => 'LONGTEXT',
            'image' => $this->string(2000),
            'discount_type' => $this->string(2000),
            'promotion_type' => $this->string(2000),
            'start_date' => $this->string(2000),
            'end_date' => $this->string(2000),
            'price' => $this->decimal(10, 2)->notNull(),
            'status' => $this->tinyInteger(2)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-promotion-created_by}}',
            '{{%promotion}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-promotion-created_by}}',
            '{{%promotion}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-promotion-updated_by}}',
            '{{%promotion}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-promotion-updated_by}}',
            '{{%promotion}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-promotion-created_by}}',
            '{{%promotion}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-promotion-created_by}}',
            '{{%promotion}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-promotion-updated_by}}',
            '{{%promotion}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-promotion-updated_by}}',
            '{{%promotion}}'
        );

        $this->dropTable('{{%promotion}}');
    }
}
