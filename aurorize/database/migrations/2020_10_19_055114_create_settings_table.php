<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('android_version')->nullable();
            $table->tinyInteger('android_force_update')->nullable()->default(0)->comment('1 - Yes , 0 - No');
            $table->double('ios_version')->nullable();
            $table->tinyInteger('ios_force_update')->nullable()->default(0)->comment('1 - Yes , 0 - No');
            $table->tinyInteger('under_maintenance')->nullable()->default(0)->comment('1 - Yes , 0 - No');
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
        Schema::dropIfExists('system_settings');
    }
}
