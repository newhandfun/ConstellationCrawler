<?php

use Carbon\Carbon;
use App\Entities\Constellation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Constellation as ConstellationModel;

class CreateConstellationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constellations', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->date('updated_date');
        });
        $now = Carbon::now();
        foreach(Constellation::TYPE_NAMES as $type=>$name){
            ConstellationModel::create([
                'type'  => $type,
                'updated_date'=>$now,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constellations');
    }
}
