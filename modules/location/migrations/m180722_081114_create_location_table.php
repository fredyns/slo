<?php

use yii\db\Migration;
use yii\db\Schema;

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
        $this->createTable('location_place', [
            'id' => Schema::TYPE_UBIGPK,
            'type_id' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'sublocation_of' => $this->bigInteger(20)->unsigned()->defaultValue(NULL),
            'latitude' => $this->float()->defaultValue(NULL),
            'longitude' => $this->float()->defaultValue(NULL),
            'created_at' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'created_by' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'updated_at' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'updated_by' => $this->integer(10)->unsigned()->defaultValue(NULL),
        ]);
        $this->createTable('location_place_lang', [
            'id' => Schema::TYPE_UBIGPK,
            'place_id' => $this->bigInteger(20)->unsigned(),
            'language' => $this->string(16)->null(),
            'name' => $this->string(1024)->null(),
        ]);
        $this->createTable('location_type', [
            'id' => Schema::TYPE_UPK,
            'created_at' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'created_by' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'updated_at' => $this->integer(10)->unsigned()->defaultValue(NULL),
            'updated_by' => $this->integer(10)->unsigned()->defaultValue(NULL),
        ]);
        $this->createTable('location_type_lang', [
            'id' => Schema::TYPE_UPK,
            'type_id' => $this->integer(10)->unsigned(),
            'language' => $this->string(16)->null(),
            'name' => $this->string(1024)->null(),
            'abbreviation' => $this->string(32)->null(),
        ]);
        $this->createTable('location_sublocation_counter', [
            'id' => Schema::TYPE_UBIGPK,
            'place_id' => $this->bigInteger(20)->unsigned(),
            'type_id' => $this->integer(10)->unsigned(),
            'quantity' => $this->integer()->defaultValue(0),
        ]);
        
        /**
         * create indexes
         */
        $this->createIndex('type', 'location_place', ['type_id']);
        $this->createIndex('sub_of', 'location_place', ['sublocation_of']);
        $this->createIndex('place', 'location_place_lang', ['place_id']);
        $this->createIndex('type', 'location_type_lang', ['type_id']);
        $this->createIndex('place', 'location_sublocation_counter', ['place_id']);
        $this->createIndex('type', 'location_sublocation_counter', ['type_id']);
        
        /**
         * create foreign keys
         */
        $this->addForeignKey('fk_location_place_type', 'location_place', 'type_id', 'location_type', 'id');
        $this->addForeignKey('fk_location_place_sub_of', 'location_place', 'sublocation_of', 'location_place', 'id');
        $this->addForeignKey('fk_location_place_lang_place', 'location_place_lang', 'place_id', 'location_place', 'id');   
        $this->addForeignKey('fk_location_type_lang_type', 'location_type_lang', 'type_id', 'location_type', 'id');        
        $this->addForeignKey('fk_location_sublocation_counter_place', 'location_sublocation_counter', 'place_id', 'location_place', 'id');
        $this->addForeignKey('fk_location_sublocation_counter_type', 'location_sublocation_counter', 'type_id', 'location_type', 'id');        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /**
         * destroy foreign keys
         */
        $this->dropForeignKey('fk_location_sublocation_counter_type', 'location_sublocation_counter');
        $this->dropForeignKey('fk_location_sublocation_counter_place', 'location_sublocation_counter');
        $this->dropForeignKey('fk_location_type_lang_type', 'location_type_lang');
        $this->dropForeignKey('fk_location_place_lang_place', 'location_place_lang');
        $this->dropForeignKey('fk_location_place_sub_of', 'location_place');
        $this->dropForeignKey('fk_location_place_type', 'location_place');
        
        /**
         * destroy indexes
         */
        $this->dropIndex('type', 'location_sublocation_counter');
        $this->dropIndex('place', 'location_sublocation_counter');
        $this->dropIndex('type', 'location_type_lang');
        $this->dropIndex('place', 'location_place_lang');
        $this->dropIndex('sub_of', 'location_place');
        $this->dropIndex('type', 'location_place');
        
        /**
         * destroy tables
         */
        $this->dropTable('location_sublocation_counter');
        $this->dropTable('location_type_lang');
        $this->dropTable('location_type');
        $this->dropTable('location_place_lang');
        $this->dropTable('location_place');
    }

}