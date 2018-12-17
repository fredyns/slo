<?php

use yii\db\Migration;

/**
 * Class m181217_090655_table_fuel
 */
class m181217_090655_table_fuel extends Migration
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

        $this->createTable('fuel', [
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

        $this->createIndex('fuel', 'instalation_generator', ['fuel_id']);
        $this->addForeignKey('fk_instalation_generator_fuel', 'instalation_generator', 'fuel_id', 'fuel', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_instalation_generator_fuel', 'instalation_generator');

        $this->dropIndex('fuel', 'instalation_generator');

        $this->dropTable('fuel');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181217_090655_table_fuel cannot be reverted.\n";

        return false;
    }
    */
}
