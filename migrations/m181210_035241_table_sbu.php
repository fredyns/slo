<?php

use yii\db\Migration;

/**
 * Class m181210_035241_table_sbu
 */
class m181210_035241_table_sbu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('sbu', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'is_deleted' => $this->boolean()->defaultValue(FALSE),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
            'name' => $this->string(512)->defaultValue(NULL),
            'address' => $this->text()->defaultValue(NULL),
            'country_id' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'province_id' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'regency_id' => $this->integer(10)->unsigned()->defaultValue(NULL),
            ], $tableOptions);

        $this->createIndex('country', 'sbu', ['country_id']);
        $this->createIndex('province', 'sbu', ['province_id']);
        $this->createIndex('regency', 'sbu', ['regency_id']);

        // relation

        $this->createIndex('sbu', 'submission', ['sbu_id']);
        $this->addForeignKey('fk_submission_sbu', 'submission', 'sbu_id', 'sbu', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_submission_sbu', 'submission');
        $this->dropTable('sbu');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181210_035241_table_sbu cannot be reverted.\n";

        return false;
    }
    */
}
