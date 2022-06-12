<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekomendationsTable extends Migration
{
    public function up()
    {
        Schema::create('rekomendations', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate();
            $table->foreignId('alternatif_id')->constrained('alternatifs')->cascadeOnUpdate();
            $table->float('bobot', 0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekomendations');
    }
}
