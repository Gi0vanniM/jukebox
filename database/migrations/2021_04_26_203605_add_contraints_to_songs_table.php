<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContraintsToSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->foreignId('genre_id')->nullable()->change()->constrained();
            // $table->foreignId('genre_id')->constrained();

            $table->foreignId('artist_id')->nullable()->change()->constrained();
            // $table->foreignId('artist_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
            $table->dropForeign(['artist_id']);
        });
    }
}
