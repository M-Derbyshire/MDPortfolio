<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCVsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->bigIncrements('id'); //May want to set up a system in the future to allow for multiple CVs, for different kinds of job
            $table->string('url');
            $table->unsignedBigInteger('logo_id');
            $table->timestamps();
            $table->unsignedBigInteger('lastChangedby');
            
            $table->foreign('logo_id')->references('id')->on('logos');
            $table->foreign('lastChangedBy')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cvs');
    }
}
