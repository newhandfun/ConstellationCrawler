<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstellationFatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constellation_fates', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('constellation_type');
            $table->tinyInteger('type');
            $table->tinyInteger('score');
            $table->string('introduction',1023);
            $table->date('created_date', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constellation_fates');
    }
}
