<?php

use yii\db\Migration;
use app\modules\location\models\Place;
use app\modules\location\models\SublocationCounter;

/**
 * Class m180806_035221_alter_sublocationof
 */
class m180806_035221_alter_sublocationof extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // drop old column
        $this->dropForeignKey('fk_location_sublocation_counter_place', SublocationCounter::tableName());
        $this->dropIndex('place', SublocationCounter::tableName());
        $this->dropColumn(SublocationCounter::tableName(), 'place_id');

        // add new column
        $this->addColumn(SublocationCounter::tableName(), 'sublocation_of', $this->bigInteger(20)->unsigned()->after('id'));
        $this->createIndex('superlocation', SublocationCounter::tableName(), ['sublocation_of']);
        $this->addForeignKey('fk_location_sublocation_counter_superloc', SublocationCounter::tableName(), 'sublocation_of', Place::tableName(), 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drop initiated column
        $this->dropForeignKey('fk_location_sublocation_counter_superloc', SublocationCounter::tableName());
        $this->dropIndex('superlocation', SublocationCounter::tableName());
        $this->dropColumn(SublocationCounter::tableName(), 'sublocation_of');

        // restore old column
        $this->addColumn(SublocationCounter::tableName(), 'place_id', $this->bigInteger(20)->unsigned()->after('id'));
        $this->createIndex('place', SublocationCounter::tableName(), ['place_id']);
        $this->addForeignKey('fk_location_sublocation_counter_place', SublocationCounter::tableName(), 'place_id', Place::tableName(), 'id');
    }
    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m180806_035221_alter_sublocationof cannot be reverted.\n";

      return false;
      }
     */

}