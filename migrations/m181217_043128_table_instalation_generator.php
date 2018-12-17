<?php

use yii\db\Migration;

/**
 * Class m181217_043128_table_instalation_generator
 */
class m181217_043128_table_instalation_generator extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        $is_mysql = ($this->db->driverName === 'mysql');
        if ($is_mysql) {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('instalation_generator', [
            'submission_id' => $this->bigInteger(19)->unsigned()->notNull(),
            'subtype_id' => $this->integer()->defaultValue(NULL),
            'capacity' => $this->decimal()->defaultValue(NULL),
            'capacity_unit' => $this->string(8)->defaultValue(NULL),
            'test_capacity' => $this->decimal()->defaultValue(NULL),
            'test_capacity_unit' => $this->string(8)->defaultValue(NULL),
            'unit_number' => $this->string(32)->defaultValue(NULL),
            'turbine_serial_number' => $this->string(64)->defaultValue(NULL),
            'generator_serial_number' => $this->string(64)->defaultValue(NULL),
            'unit' => $this->string(128)->defaultValue(NULL),
            'fuel_id' => $this->integer()->defaultValue(NULL),
            'module_quantity' => $this->smallInteger()->defaultValue(NULL),
            'each_module_capacity' => $this->string(64)->defaultValue(NULL),
            'inverter_quantity' => $this->smallInteger()->defaultValue(NULL),
            'each_inverter_capacity' => $this->string(64)->defaultValue(NULL),
            'calorific_value' => $this->string(64)->defaultValue(NULL),
            'calorific_value_file_id' => $this->integer()->defaultValue(NULL),
            'fuel_consumption_hhv' => $this->string(64)->defaultValue(NULL),
            'fuel_consumption_lhv' => $this->string(64)->defaultValue(NULL),
            'fuel_consumption_rate_file_id' => $this->integer()->defaultValue(NULL),
            'sfc' => $this->string(64)->defaultValue(NULL),
            ], $tableOptions);

        if ($is_mysql) {
            $this->db->createCommand("ALTER TABLE `instalation_generator` ADD PRIMARY KEY(`submission_id`);")->execute();
        } else{
            $this->createIndex('submission_id', 'instalation_generator', 'submission_id', TRUE);
        }

        $this->addForeignKey('fk_instalation_generator_submission', 'instalation_generator', 'submission_id', 'submission', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_instalation_generator_submission', 'instalation_generator');

        $this->dropTable('instalation_generator');
    }
    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m181217_043128_table_electrical_generator cannot be reverted.\n";

      return false;
      }
     */

}