<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
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
            $table->unsignedBigInteger('logo_id');
            $table->string('githubUrl');
            $table->string('zipUrl');
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
        Schema::dropIfExists('projects');
    }
}
