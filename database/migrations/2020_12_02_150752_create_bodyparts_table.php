<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodypartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodyparts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // pivot table or linking table (between bodyparts and exercises)
        Schema::create('bodypart_exercise', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bodypart_id');
            $table->unsignedBigInteger('exercise_id');
            $table->timestamps();

            // De combinatie van beide id's moet uniek zijn
            $table->unique(['bodypart_id','exercise_id']);

            $table->foreign('bodypart_id')->references('id')->on('bodyparts')->onDelete('cascade');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bodyparts');
    }
}
