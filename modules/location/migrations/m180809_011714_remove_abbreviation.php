<?php

use yii\db\Migration;
use app\modules\location\models\TypeLang;

/**
 * Class m180809_011714_remove_abbreviation
 */
class m180809_011714_remove_abbreviation extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn(TypeLang::tableName(), 'abbreviation');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn(TypeLang::tableName(), 'abbreviation', $this->string(32)->null()->after('name'));
    }
    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m180809_011714_remove_abbreviation cannot be reverted.\n";

      return false;
      }
     */

}