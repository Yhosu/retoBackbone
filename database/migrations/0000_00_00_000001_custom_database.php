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
            $table->integer('federal_entity_id')->unsigned();
            $table->integer('municipality_id')->unsigned();
            $table->timestamps();
            $table->foreign('federal_entity_id')->references('id')->on('federal_entities')->onDelete('restrict');
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('restrict');
            $table->index(['federal_entity_id', 'municipality_id']);
        });
        Schema::create('settlement_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::create('settlements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('zip_code_id')->unsigned();
            $table->integer('key')->nullable();
            $table->string('name')->nullable();
            $table->string('zone_type')->nullable();
            $table->integer('settlement_type_id')->unsigned();
            $table->timestamps();
            $table->foreign('zip_code_id')->references('id')->on('zip_codes')->onDelete('restrict');
            $table->foreign('settlement_type_id')->references('id')->on('settlement_types')->onDelete('restrict');
            $table->index(['zip_code_id', 'settlement_type_id']);
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