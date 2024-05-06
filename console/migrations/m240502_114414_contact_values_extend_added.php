<?php

use yii\db\Migration;

/**
 * Class m240502_114414_contact_values_extend_added
 */
class m240502_114414_contact_values_extend_added extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'ALTER TABLE acc_contact_values ADD added VARCHAR (255) DEFAULT NULL AFTER phone';
        Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240502_114414_contact_values_extend_added cannot be reverted.\n";

        return false;
    }
}
