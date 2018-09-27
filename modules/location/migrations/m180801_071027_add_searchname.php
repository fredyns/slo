<?php

use yii\db\Migration;
use yii\db\Schema;
use app\modules\location\models\Place;

/**
 * Class m180801_071027_add_searchname
 */
class m180801_071027_add_searchname extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Place::tableName(), 'search_name', $this->text()->after('type_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Place::tableName(), 'search_name');
    }
    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m180801_071027_add_searchname cannot be reverted.\n";

      return false;
      }
     */

}