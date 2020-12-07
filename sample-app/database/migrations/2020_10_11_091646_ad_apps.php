<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdApps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_apps', function (Blueprint $table) {
            $table->increments('app_id');
            $table->integer('sdk_app_id');
            $table->integer('store_app_id');
            $table->string('app_name');
            $table->integer('app_type_id');
            $table->integer('sdk_id');
            $table->string('api_key');
            $table->integer('partner_id');
            $table->integer('is_asp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
