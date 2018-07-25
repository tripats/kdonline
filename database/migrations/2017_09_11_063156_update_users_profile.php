<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('street')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('birthday')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('fixed_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('homepage')->nullable();
            $table->text('vita')->nullable();
            $table->text('exhibition')->nullable();
            $table->boolean('newsletter')->default(0);
            $table->boolean('ideenstorming')->default(0);
            $table->boolean('profile_public')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // wird nicht gebraucht weil table vorher gedropped wird

        /*Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('street');
            $table->dropColumn('postcode');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('birthday');
            $table->dropColumn('fixed_number');
            $table->dropColumn('birthplace');
            $table->dropColumn('mobile_number');
            $table->dropColumn('homepage');
            $table->dropColumn('exhibition');
            $table->dropColumn('newsletter');
            $table->dropColumn('city');
            $table->dropColumn('vita');
            $table->dropColumn('ideenstorming');
            $table->dropColumn('profile_public');
        });
        */
    }
}
