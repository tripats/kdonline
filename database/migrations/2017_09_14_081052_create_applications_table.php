<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('expectations')->nullable();
            $table->text('description')->nullable();
            $table->integer('activity_id')->unsigned()->default(0);
            $table->integer('application_year')->unsigned();
            $table->boolean('family')->default(0);
            $table->integer('preferred_start')->unsigned()->default(0);
            $table->string('homepage')->nullable();
            $table->integer('duration')->unsigned()->default(0);
            $table->boolean('is_painting')->unsigned()->default(0);
            $table->boolean('is_graphic')->default(0);
            $table->boolean('is_photography')->default(0);
            $table->boolean('is_video')->default(0);
            $table->boolean('is_sculpture')->default(0);
            $table->boolean('is_installation')->default(0);
            $table->boolean('is_object')->default(0);
            $table->boolean('is_performance')->default(0);
            $table->boolean('is_mixed_media')->default(0);
            $table->boolean('is_participative')->default(0);
            $table->boolean('is_sound')->default(0);
            $table->boolean('is_internet')->default(0);
            $table->boolean('is_interdisciplinary')->default(0);
            $table->boolean('is_focus_visual')->default(0);
            $table->boolean('is_focus_sciences')->default(0);
            $table->boolean('is_focus_economics')->default(0);
            $table->boolean('is_energy')->default(0);
            $table->boolean('is_roman')->default(0);
            $table->boolean('is_theather')->default(0);
            $table->boolean('is_literature_both')->default(0);
            $table->boolean('is_proposed')->default(0);
            $table->boolean('is_international')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
