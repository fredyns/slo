<?php

use yii\db\Migration;

/**
 * Class m181217_091512_table_transmission_network
 */
class m181217_091512_table_transmission_network extends Migration
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

        $this->createTable('transmission_network', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'is_deleted' => $this->boolean()->defaultValue(FALSE),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
            'name' => $this->string(512)->defaultValue(NULL),
            ], $tableOptions);

        // link to instalation generator

        $this->createIndex('transmission_network', 'instalation_transmission', ['network_id']);
        $this->addForeignKey('fk_instalation_transmission_network', 'instalation_transmission', 'network_id', 'transmission_network', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_instalation_transmission_network', 'instalation_transmission');

        $this->dropIndex('transmission_network', 'instalation_transmission');

        $this->dropTable('transmission_network');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181217_091512_table_transmission_network cannot be reverted.\n";

        return false;
    }
    */
}
