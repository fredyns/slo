<?php

use yii\db\Migration;

/**
 * Class m181210_071755_table_technical_personel
 */
class m181210_071755_table_technical_personel extends Migration
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

        $this->createTable('technical_personel', [
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

        $this->createIndex('country', 'technical_personel', ['country_id']);
        $this->createIndex('province', 'technical_personel', ['province_id']);
        $this->createIndex('regency', 'technical_personel', ['regency_id']);

        // relation

        $this->createIndex('technical_personel', 'submission', ['technical_personel_id']);
        $this->addForeignKey('fk_submission_tcpersonel', 'submission', 'technical_personel_id', 'technical_personel', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_submission_tcpersonel', 'submission');
        $this->dropTable('technical_personel');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181210_071755_table_technical_personel cannot be reverted.\n";

        return false;
    }
    */
}
