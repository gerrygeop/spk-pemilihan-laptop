<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternatifMaxBobotTable extends Migration
{
    public function up()
    {
        Schema::create('alternatif_max_bobot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_id')
                ->constrained('alternatifs')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alternatif_max_bobot');
    }
}
