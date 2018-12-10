<?php

use yii\db\Migration;
use app\dictionaries\SubmissionProgressStatus;

/**
 * Class m181207_064840_table_submission
 */
class m181207_064840_table_submission extends Migration
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

        // EFC = Electrical Feasible Certificate
        $this->createTable('submission', [
            'id' => $this->bigPrimaryKey(19)->unsigned(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'is_deleted' => $this->boolean()->defaultValue(FALSE),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
            'agenda_number' => $this->string(64)->defaultValue(NULL),
            'progress_status' => $this->tinyInteger()->defaultValue(SubmissionProgressStatus::REQUEST),
            'examination_date' => $this->date()->defaultValue(NULL),
            'owner_id' => $this->integer()->defaultValue(NULL),
            'instalation_name' => $this->string(128)->defaultValue(NULL),
            'instalation_location' => $this->text()->defaultValue(NULL),
            'instalation_country_id' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'instalation_province_id' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'instalation_regency_id' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'instalation_latitude' => $this->decimal()->defaultValue(NULL),
            'instalation_longitude' => $this->decimal()->defaultValue(NULL),
            'bussiness_type_id' => $this->integer()->defaultValue(NULL),
            'sbu_id' => $this->integer()->defaultValue(NULL),
            'technical_pic_id' => $this->integer()->defaultValue(NULL),
            'technical_personel_id' => $this->integer()->defaultValue(NULL),
            'report_number' => $this->string(64)->defaultValue(NULL),
            'report_file_id' => $this->integer()->defaultValue(NULL),
            'requested_at' => $this->integer(),
            'requested_by' => $this->integer(),
            'registering_at' => $this->integer(),
            'registering_by' => $this->integer(),
            'registered_at' => $this->integer(),
            'registered_by' => $this->integer(),
            ], $tableOptions);
        
        $this->createIndex('instalation_country', 'submission', ['instalation_country_id']);
        $this->createIndex('instalation_province', 'submission', ['instalation_province_id']);
        $this->createIndex('instalation_regency', 'submission', ['instalation_regency_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('submission');
    }
    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m181207_064840_table_submission cannot be reverted.\n";

      return false;
      }
     */

}