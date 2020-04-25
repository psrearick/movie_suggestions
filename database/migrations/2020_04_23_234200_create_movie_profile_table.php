<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('movie_id')
                ->constrained()
                ->onDelete('cascade');
            $table->boolean('favorite');
            $table->boolean('watch_list');
            $table->integer('seen');
            $table->integer('rating');
            $table->timestamps();

            $table->unique(['profile_id', 'movie_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_profile');
    }
}
