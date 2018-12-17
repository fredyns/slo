<?php

use yii\db\Migration;

/**
 * Class m181217_084232_table_instalation_utilization
 */
class m181217_084232_table_instalation_utilization extends Migration
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

        $this->createTable('instalation_utilization', [
            'submission_id' => $this->bigInteger(19)->unsigned()->notNull(),
            'subtype_id' => $this->integer()->defaultValue(NULL),
            'substation_transformer_kva' => $this->decimal()->defaultValue(NULL),
            'connected_power_kva' => $this->decimal()->defaultValue(NULL),
            'medium_voltage_connecting_panel_quantity' => $this->smallInteger()->defaultValue(NULL),
            'low_voltage_connecting_panel_quantity' => $this->smallInteger()->defaultValue(NULL),
            'electricity_provider' => $this->string(512)->defaultValue(NULL),
            ], $tableOptions);

        if ($is_mysql) {
            $this->db->createCommand("ALTER TABLE `instalation_utilization` ADD PRIMARY KEY(`submission_id`);")->execute();
        } else{
            $this->createIndex('submission_id', 'instalation_utilization', 'submission_id', TRUE);
        }

        $this->addForeignKey('fk_instalation_utilization_submission', 'instalation_utilization', 'submission_id', 'submission', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_instalation_utilization_submission', 'instalation_utilization');

        $this->dropTable('instalation_utilization');
    }
    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m181217_084232_table_instalation_utilization cannot be reverted.\n";

      return false;
      }
     */

}