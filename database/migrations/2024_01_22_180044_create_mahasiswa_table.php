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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->integer('nim', 9);
            $table->string('nama');
            $table->foreignId('id_jurusan')->constrained('jurusan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_prodi')->constrained('prodi')->onDelete('cascade')->onUpdate('cascade');
            $table->string('jalur_masuk');
            $table->string('ponsel');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
