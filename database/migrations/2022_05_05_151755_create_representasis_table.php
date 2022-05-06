<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentasisTable extends Migration
{
    public function up()
    {
        Schema::create('representasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')
                ->constrained('kriterias')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('keterangan');
            $table->float('min', 0)->nullable();
            $table->float('max', 0)->nullable();
            $table->float('nilai', 0)->nullable();
            $table->float('bobot', 0)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('representasis');
    }
}
