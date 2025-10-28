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
        Schema::create('sub', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kriteria')->constrained('kriteria')->onDelete('cascade')->onUpdate('cascade');
            $table->string("nama_sub", 100);
            $table->float("bobot")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub');
    }
};
