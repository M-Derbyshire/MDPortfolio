<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMakeLastChangedByFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("users", function (Blueprint $table) {
            $table->unsignedBigInteger('lastChangedBy')->nullable()->constrained()->change();
        });
		
		Schema::table("cvs", function (Blueprint $table) {
            $table->unsignedBigInteger('lastChangedBy')->nullable()->constrained()->change();
        });
		
		Schema::table("aboutLinks", function (Blueprint $table) {
            $table->unsignedBigInteger('lastChangedBy')->nullable()->constrained()->change();
        });
		
		Schema::table("tools", function (Blueprint $table) {
            $table->unsignedBigInteger('lastChangedBy')->nullable()->constrained()->change();
        });
		
		Schema::table("projects", function (Blueprint $table) {
            $table->unsignedBigInteger('lastChangedBy')->nullable()->constrained()->change();
        });
		
		Schema::table("logos", function (Blueprint $table) {
            $table->unsignedBigInteger('lastChangedBy')->nullable()->constrained()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		//If you're having issues with this, you may need to delete any records that have a 
		//null lastChangedBy
        Schema::table("users", function (Blueprint $table) {
            $table->unsignedBigInteger('lastChangedBy')->nullable(false)->change();
        });
		
		Schema::table("cvs", function (Blueprint $table) {
            $table->unsignedBigInteger('lastChangedBy')->nullable(false)->change();
        });
		
		Schema::table("aboutLinks", function (Blueprint $table) {
            $table->unsignedBigInteger('lastChangedBy')->nullable(false)->change();
        });
		
		Schema::table("tools", function (Blueprint $table) {
            $table->unsignedBigInteger('lastChangedBy')->nullable(false)->change();
        });
		
		Schema::table("projects", function (Blueprint $table) {
            $table->unsignedBigInteger('lastChangedBy')->nullable(false)->change();
        });
		
		Schema::table("logos", function (Blueprint $table) {
            $table->unsignedBigInteger('lastChangedBy')->nullable(false)->change();
        });
    }
}
