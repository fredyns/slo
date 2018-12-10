<?php

use yii\db\Migration;

/**
 * Class m181210_071350_table_technical_pic
 */
class m181210_071350_table_technical_pic extends Migration
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

        $this->createTable('technical_pic', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'is_deleted' => $this->boolean()->defaultValue(FALSE),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
            'name' => $this->string(512)->defaultValue(NULL),
            'phone' => $this->string(64)->defaultValue(NULL),
            'email' => $this->string(64)->defaultValue(NULL),
            'address' => $this->text()->defaultValue(NULL),
            'country_id' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'province_id' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'regency_id' => $this->integer(10)->unsigned()->defaultValue(NULL),
            ], $tableOptions);

        $this->createIndex('country', 'technical_pic', ['country_id']);
        $this->createIndex('province', 'technical_pic', ['province_id']);
        $this->createIndex('regency', 'technical_pic', ['regency_id']);

        // relation

        $this->createIndex('technical_pic', 'submission', ['technical_pic_id']);
        $this->addForeignKey('fk_submission_tcpic', 'submission', 'technical_pic_id', 'technical_pic', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_submission_tcpic', 'submission');
        $this->dropTable('technical_pic');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181210_071350_table_technical_pic cannot be reverted.\n";

        return false;
    }
    */
}
