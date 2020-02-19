<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable19022020 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('smallDescription');
            $table->text('description');
            $table->unsignedBigInteger('logoUrl_id');
            $table->unsignedBigInteger('githubUrl_id');
            $table->unsignedBigInteger('zipUrl_id');
            $table->timestamps();
            $table->unsignedBigInteger('lastChangedby');
            
            $table->foreign('logoUrl_id')->references('id')->on('urls');
            $table->foreign('githubUrl_id')->references('id')->on('urls')->nullable();
            $table->foreign('zipUrl_id')->references('id')->on('urls')->nullable();
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
        Schema::dropIfExists('projects_table_19022020');
    }
}
