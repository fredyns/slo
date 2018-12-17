<?php

use yii\db\Migration;

/**
 * Class m181217_085931_table_instalation_subtype
 */
class m181217_085931_table_instalation_subtype extends Migration
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

        $this->createTable('instalation_subtype', [
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

        $this->createIndex('subtype', 'instalation_generator', ['subtype_id']);
        $this->addForeignKey('fk_instalation_generator_subtype', 'instalation_generator', 'subtype_id', 'instalation_subtype', 'id');

        // link to instalation transmission

        $this->createIndex('subtype', 'instalation_transmission', ['subtype_id']);
        $this->addForeignKey('fk_instalation_transmission_subtype', 'instalation_transmission', 'subtype_id', 'instalation_subtype', 'id');

        // link to instalation distribution

        $this->createIndex('subtype', 'instalation_distribution', ['subtype_id']);
        $this->addForeignKey('fk_instalation_distribution_subtype', 'instalation_distribution', 'subtype_id', 'instalation_subtype', 'id');

        // link to instalation utilization

        $this->createIndex('subtype', 'instalation_utilization', ['subtype_id']);
        $this->addForeignKey('fk_instalation_utilization_subtype', 'instalation_utilization', 'subtype_id', 'instalation_subtype', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_instalation_utilization_subtype', 'instalation_utilization');
        $this->dropForeignKey('fk_instalation_distribution_subtype', 'instalation_distribution');
        $this->dropForeignKey('fk_instalation_transmission_subtype', 'instalation_transmission');
        $this->dropForeignKey('fk_instalation_generator_subtype', 'instalation_generator');

        $this->dropIndex('subtype', 'instalation_utilization');
        $this->dropIndex('subtype', 'instalation_distribution');
        $this->dropIndex('subtype', 'instalation_transmission');
        $this->dropIndex('subtype', 'instalation_generator');

        $this->dropTable('instalation_subtype');
    }
    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m181217_085931_table_instalation_subtype cannot be reverted.\n";

      return false;
      }
     */

}