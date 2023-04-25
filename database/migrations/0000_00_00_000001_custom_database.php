<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federal_entities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('key')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->timestamps();
        });
        Schema::create('municipalities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('key')->nullable();
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('zip_code')->nullable();
            $table->string('locality')->nullable();
            $table->integer('federal_entity_id')->nullable();
            $table->integer('municipality_id')->nullable();
            $table->timestamps();
        });
        Schema::create('settlement_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::create('settlements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('zip_code_id')->nullable();
            $table->integer('key')->nullable();
            $table->string('name')->nullable();
            $table->string('zone_type')->nullable();
            $table->integer('settlement_type_id')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
    }
}