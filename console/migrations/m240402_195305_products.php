<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m240402_195305_products
 */
class m240402_195305_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'category_id'           => Schema::TYPE_INTEGER . ' NOT NULL',
            'name'                  => Schema::TYPE_STRING . ' NOT NULL',
            'description'           => Schema::TYPE_TEXT,
            'short_description'     => Schema::TYPE_TEXT,
            'alias'                 => Schema::TYPE_STRING,
            'barcode'               => Schema::TYPE_STRING,
            'price'                 => Schema::TYPE_STRING,
            'marketing_price'       => Schema::TYPE_STRING,

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
        $this->dropTable('{{%products}}');
    }
}
