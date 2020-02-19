<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aboutLinks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('text');
            $table->unsignedBigInteger('url_id');
            $table->unsignedBigInteger('logoUrl_id');
            $table->timestamps();
            $table->unsignedBigInteger('lastChangedBy');
            
            $table->foreign('url_id')->references('id')->on('urls');
            $table->foreign('logoUrl_id')->references('id')->on('urls');
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
        Schema::dropIfExists('about_links');
    }
}
