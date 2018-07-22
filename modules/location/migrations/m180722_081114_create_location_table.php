<?php

use yii\db\Migration;
use yii\db\Schema;
use app\modules\location\models\Place;
use app\modules\location\models\PlaceLang;
use app\modules\location\models\Type;
use app\modules\location\models\TypeLang;
use app\modules\location\models\SublocationCounter;

/**
 * Handles the creation of tables location module.
 */
class m180722_081114_create_location_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * create table structures
         */
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(Place::tableName(), [
            'id' => Schema::TYPE_UBIGPK,
            'type_id' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'sublocation_of' => $this->bigInteger(20)->unsigned()->defaultValue(NULL),
            'latitude' => $this->float()->defaultValue(NULL),
            'longitude' => $this->float()->defaultValue(NULL),
            'created_at' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'created_by' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'updated_at' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'updated_by' => $this->integer(10)->unsigned()->defaultValue(NULL),
        ], $tableOptions);
        $this->createTable(PlaceLang::tableName(), [
            'id' => Schema::TYPE_UBIGPK,
            'place_id' => $this->bigInteger(20)->unsigned(),
            'language' => $this->string(16)->null(),
            'name' => $this->string(1024)->null(),
        ], $tableOptions);
        $this->createTable(Type::tableName(), [
            'id' => Schema::TYPE_UPK,
            'created_at' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'created_by' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'updated_at' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'updated_by' => $this->integer(10)->unsigned()->defaultValue(NULL),
        ], $tableOptions);
        $this->createTable(TypeLang::tableName(), [
            'id' => Schema::TYPE_UPK,
            'type_id' => $this->integer(10)->unsigned(),
            'language' => $this->string(16)->null(),
            'name' => $this->string(1024)->null(),
            'abbreviation' => $this->string(32)->null(),
        ], $tableOptions);
        $this->createTable(SublocationCounter::tableName(), [
            'id' => Schema::TYPE_UBIGPK,
            'place_id' => $this->bigInteger(20)->unsigned(),
            'type_id' => $this->integer(10)->unsigned(),
            'quantity' => $this->integer()->defaultValue(0),
        ]);
        
        /**
         * create indexes
         */
        $this->createIndex('type', Place::tableName(), ['type_id']);
        $this->createIndex('sub_of', Place::tableName(), ['sublocation_of']);
        $this->createIndex('place', PlaceLang::tableName(), ['place_id']);
        $this->createIndex('type', TypeLang::tableName(), ['type_id']);
        $this->createIndex('place', SublocationCounter::tableName(), ['place_id']);
        $this->createIndex('type', SublocationCounter::tableName(), ['type_id']);
        
        /**
         * create foreign keys
         */
        $this->addForeignKey('fk_location_place_type', Place::tableName(), 'type_id', Type::tableName(), 'id');
        $this->addForeignKey('fk_location_place_sub_of', Place::tableName(), 'sublocation_of', Place::tableName(), 'id');
        $this->addForeignKey('fk_location_place_lang_place', PlaceLang::tableName(), 'place_id', Place::tableName(), 'id');   
        $this->addForeignKey('fk_location_type_lang_type', TypeLang::tableName(), 'type_id', Type::tableName(), 'id');        
        $this->addForeignKey('fk_location_sublocation_counter_place', SublocationCounter::tableName(), 'place_id', Place::tableName(), 'id');
        $this->addForeignKey('fk_location_sublocation_counter_type', SublocationCounter::tableName(), 'type_id', Type::tableName(), 'id');        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /**
         * destroy foreign keys
         */
        $this->dropForeignKey('fk_location_sublocation_counter_type', SublocationCounter::tableName());
        $this->dropForeignKey('fk_location_sublocation_counter_place', SublocationCounter::tableName());
        $this->dropForeignKey('fk_location_type_lang_type', TypeLang::tableName());
        $this->dropForeignKey('fk_location_place_lang_place', PlaceLang::tableName());
        $this->dropForeignKey('fk_location_place_sub_of', Place::tableName());
        $this->dropForeignKey('fk_location_place_type', Place::tableName());
        
        /**
         * destroy indexes
         */
        $this->dropIndex('type', SublocationCounter::tableName());
        $this->dropIndex('place', SublocationCounter::tableName());
        $this->dropIndex('type', TypeLang::tableName());
        $this->dropIndex('place', PlaceLang::tableName());
        $this->dropIndex('sub_of', Place::tableName());
        $this->dropIndex('type', Place::tableName());
        
        /**
         * destroy tables
         */
        $this->dropTable(SublocationCounter::tableName());
        $this->dropTable(TypeLang::tableName());
        $this->dropTable(Type::tableName());
        $this->dropTable(PlaceLang::tableName());
        $this->dropTable(Place::tableName());
    }

}