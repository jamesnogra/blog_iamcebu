<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authors', function($table) {
            $table->string("code", 32)->unique()->after('id');
        });
        Schema::table('articles', function($table) {
            $table->string("code", 32)->unique()->after('id');
        });
        Schema::table('comments', function($table) {
            $table->string("code", 32)->unique()->after('id');
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
