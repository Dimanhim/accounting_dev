<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m240402_195646_store_contacts
 */
class m240402_195646_store_contacts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_contacts}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'store_id'              => Schema::TYPE_INTEGER . ' NOT NULL',
            'name'                  => Schema::TYPE_STRING . ' NOT NULL',
            'phone'                 => Schema::TYPE_STRING,
            'email'                 => Schema::TYPE_STRING,
            'comment'               => Schema::TYPE_TEXT,

            'is_active'             => Schema::TYPE_SMALLINT . ' DEFAULT 1',
            'deleted'               => Schema::TYPE_SMALLINT,
            'position'              => Schema::TYPE_INTEGER,
            'created_at'            => Schema::TYPE_INTEGER,
            'updated_at'            => Schema::TYPE_INTEGER,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_contacts}}');
    }
}
