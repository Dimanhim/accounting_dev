<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m240402_195140_organization_contacts
 */
class m240402_195140_organization_contacts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%organization_contacts}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'organization_id'       => Schema::TYPE_INTEGER . ' NOT NULL',
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
        $this->dropTable('{{%stores}}');
    }
}
