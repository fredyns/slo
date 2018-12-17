<?php

use yii\db\Migration;

/**
 * Class m181217_040511_add_electrical_instalation_type
 */
class m181217_040511_add_electrical_instalation_type extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('submission', 'instalation_type', $this->smallInteger()->defaultValue(NULL)->after('instalation_name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('submission', 'instalation_type');
    }
    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m181217_040511_add_electrical_instalation_type cannot be reverted.\n";

      return false;
      }
     */

}