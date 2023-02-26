<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%settings}}`.
 */
class m230224_173950_create_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'company_name' => $this->string(100),
            'address_line_1' => $this->string(255),
            'address_line_2' => $this->string(255),
            'city' => $this->string(255),
            'state' => $this->string(55),
            'postal_code' => $this->string(255),
            'country' => $this->string(55),
            'country_code' => $this->string(55),
            'phone_no' => $this->string(55),
            'gst' => $this->string(55),
            'company_logo' => $this->text(),
            'gst_number' => $this->string(255),
            'sales_prefix' => $this->string(55),
            'company_email' => $this->string(255),                                                   

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
