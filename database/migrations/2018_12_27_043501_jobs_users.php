<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JobsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('jobs_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job')->unsigned();
            $table->foreign('job')->references('id')->on('jobs');
            $table->integer('applicant')->unsigned();
            $table->foreign('applicant')->references('id')->on('users'); 
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
        //
    }
}
