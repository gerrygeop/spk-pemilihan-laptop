<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculationsTable extends Migration
{
    public function up()
    {
        Schema::create('calculations', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kriteria_id')->constrained('kriterias')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calculations');
    }
}
