<?php

use yii\db\Migration;

/**
 * Class m181217_080728_table_instalation_distribution
 */
class m181217_080728_table_instalation_distribution extends Migration
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

        $this->createTable('instalation_distribution', [
            'submission_id' => $this->bigInteger(19)->unsigned()->notNull(),
            'subtype_id' => $this->integer()->defaultValue(NULL),
            'ownership_status_id' => $this->integer()->defaultValue(NULL),
            'distribution_region' => $this->string(4)->defaultValue(NULL),
            'jtm_length_kms' => $this->decimal()->defaultValue(NULL),
            'sktm_length_ms' => $this->decimal()->defaultValue(NULL),
            'sutm_length_ms' => $this->decimal()->defaultValue(NULL),
            'jtr_length_kms' => $this->decimal()->defaultValue(NULL),
            'sktr_length_ms' => $this->decimal()->defaultValue(NULL),
            'sutr_length_ms' => $this->decimal()->defaultValue(NULL),
            'substation_capacity_kva' => $this->decimal()->defaultValue(NULL),
            'voltage_id' => $this->integer()->defaultValue(NULL),
            'substation_quantity' => $this->smallInteger()->defaultValue(NULL),
            'panel_quantity' => $this->smallInteger()->defaultValue(NULL),
            'short_circuit_capacity_a' => $this->decimal()->defaultValue(NULL),
            ], $tableOptions);

        if ($is_mysql) {
            $this->db->createCommand("ALTER TABLE `instalation_distribution` ADD PRIMARY KEY(`submission_id`);")->execute();
        } else{
            $this->createIndex('submission_id', 'instalation_distribution', 'submission_id', TRUE);
        }

        $this->addForeignKey('fk_instalation_distribution_submission', 'instalation_distribution', 'submission_id', 'submission', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_instalation_distribution_submission', 'instalation_distribution');

        $this->dropTable('instalation_distribution');
    }
    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m181217_080728_table_instalation_distribution cannot be reverted.\n";

      return false;
      }
     */

}