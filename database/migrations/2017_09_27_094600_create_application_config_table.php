<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_config', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_info_id')->unsigned()->index();
            $table->foreign('application_info_id')->references('id')->on('application_infos');
            $table->integer('application_year')->nullable();
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
        Schema::dropIfExists('application_config');
    }
}
