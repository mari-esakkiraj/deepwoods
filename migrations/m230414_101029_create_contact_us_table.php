<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact_us}}`.
 */
class m230414_101029_create_contact_us_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE `contact_us` (
            `id` int(11) NOT NULL,
            `name` varchar(255) DEFAULT NULL,
            `email` varchar(255) DEFAULT NULL,
            `message` varchar(2000) DEFAULT NULL,
            `status` tinyint(2) NOT NULL,
            `created_at` int(11) DEFAULT NULL,
            `updated_at` int(11) DEFAULT NULL,
            `created_by` int(11) DEFAULT NULL,
            `updated_by` int(11) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
        Yii::$app->db->createCommand($sql)->execute();
        $sql = "ALTER TABLE `contact_us`
        ADD PRIMARY KEY (`id`)";
        Yii::$app->db->createCommand($sql)->execute();
        $sql = "ALTER TABLE `contact_us`
        MODIFY `id` int(1) NOT NULL AUTO_INCREMENT";
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contact_us}}');
    }
}
