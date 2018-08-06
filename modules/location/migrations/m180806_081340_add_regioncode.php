<?php

use yii\db\Migration;
use app\modules\location\models\Place;

/**
 * Class m180806_081340_add_regioncode
 */
class m180806_081340_add_regioncode extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add new column
        $this->addColumn(Place::tableName(), 'region_code', $this->string(32)->after('id'));
        $this->createIndex('region_code', Place::tableName(), ['region_code']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drop old column
        $this->dropIndex('region_code', Place::tableName());
        $this->dropColumn(Place::tableName(), 'region_code');
    }
    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m180806_081340_add_regioncode cannot be reverted.\n";

      return false;
      }
     */

}