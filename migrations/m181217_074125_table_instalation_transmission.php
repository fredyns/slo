<?php

use yii\db\Migration;

/**
 * Class m181217_074125_table_instalation_transmission
 */
class m181217_074125_table_instalation_transmission extends Migration
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

        $this->createTable('instalation_transmission', [
            'submission_id' => $this->bigInteger(19)->unsigned()->notNull(),
            'subtype_id' => $this->integer()->defaultValue(NULL),
            'ownership_status_id' => $this->integer()->defaultValue(NULL),
            'network_id' => $this->integer()->defaultValue(NULL),
            'jtet' => $this->string(128)->defaultValue(NULL),
            'jtt' => $this->string(128)->defaultValue(NULL),
            'voltage_id' => $this->integer()->defaultValue(NULL),
            'power_house_capacity' => $this->string(32)->defaultValue(NULL),
            'tower' => $this->string(64)->defaultValue(NULL),
            'line_bay' => $this->string(64)->defaultValue(NULL),
            'bus_coupler_bay' => $this->string(64)->defaultValue(NULL),
            'transformer_bay' => $this->string(64)->defaultValue(NULL),
            'power_breaker_capacity' => $this->string(64)->defaultValue(NULL),
            'power_transformer_capacity' => $this->string(64)->defaultValue(NULL),
            ], $tableOptions);

        if ($is_mysql) {
            $this->db->createCommand("ALTER TABLE `instalation_transmission` ADD PRIMARY KEY(`submission_id`);")->execute();
        } else{
            $this->createIndex('submission_id', 'instalation_transmission', 'submission_id', TRUE);
        }

        $this->addForeignKey('fk_instalation_transmission_submission', 'instalation_transmission', 'submission_id', 'submission', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_instalation_transmission_submission', 'instalation_transmission');

        $this->dropTable('instalation_transmission');
    }
    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m181217_074125_table_transmission cannot be reverted.\n";

      return false;
      }
     */

}