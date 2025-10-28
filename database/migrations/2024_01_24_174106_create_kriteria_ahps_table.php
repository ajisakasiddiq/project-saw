<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kriteria_ahps', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kriteria1');
            $table->integer('id_kriteria2');
            $table->float('nilai1');
            $table->float('nilai2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_ahps');
    }
};
