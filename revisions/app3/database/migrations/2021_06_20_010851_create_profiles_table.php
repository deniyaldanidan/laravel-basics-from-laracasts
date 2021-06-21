<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('country', 50);
            $table->string('state',50);
            $table->string('city', 50);
            
            $table->string('twitter',50)->nullable();
            $table->string('instagram', 50)->nullable();

            $table->date('birthdate');
            $table->string('occupation', 50)->nullable();
            $table->string('company',50)->nullable();
            
            $table->string('about',500)->nullable();
            $table->set('gender', ['male', 'female']);
            $table->string('phone',20)->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
