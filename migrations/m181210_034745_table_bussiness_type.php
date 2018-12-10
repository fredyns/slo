<?php

use yii\db\Migration;

/**
 * Class m181210_034745_table_bussiness_type
 */
class m181210_034745_table_bussiness_type extends Migration
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

        $this->createTable('bussiness_type', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'is_deleted' => $this->boolean()->defaultValue(FALSE),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
            'name' => $this->string(128)->defaultValue(NULL),
            ], $tableOptions);

        // relation

        $this->createIndex('bussiness_type', 'submission', ['bussiness_type_id']);
        $this->addForeignKey('fk_submission_bsstype', 'submission', 'bussiness_type_id', 'bussiness_type', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_submission_bsstype', 'submission');
        $this->dropTable('bussiness_type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181210_034745_table_bussiness_type cannot be reverted.\n";

        return false;
    }
    */
}
