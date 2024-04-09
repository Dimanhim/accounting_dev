<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m240402_195417_product_properties
 */
class m240402_195417_product_properties extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_properties}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'category_id'           => Schema::TYPE_INTEGER . ' NOT NULL',
            'type_id'               => Schema::TYPE_INTEGER . ' NOT NULL',
            'name'                  => Schema::TYPE_STRING . ' NOT NULL',
            'description'           => Schema::TYPE_TEXT,
            'short_description'     => Schema::TYPE_TEXT,

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
        $this->dropTable('{{%product_properties}}');
    }
}
