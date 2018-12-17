<?php

use yii\db\Migration;

/**
 * Class m181217_091109_rename_ownership_status_id
 */
class m181217_091109_rename_ownership_status_id extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('instalation_transmission', 'ownership_status_id', 'ownership_status');
        $this->renameColumn('instalation_distribution', 'ownership_status_id', 'ownership_status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('instalation_transmission', 'ownership_status', 'ownership_status_id');
        $this->renameColumn('instalation_distribution', 'ownership_status', 'ownership_status_id');
    }
    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m181217_091109_rename_ownership_status_id cannot be reverted.\n";

      return false;
      }
     */

}