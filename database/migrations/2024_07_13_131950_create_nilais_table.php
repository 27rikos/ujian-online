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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_matakuliah')->constrained('matakuliahs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_mahasiswa');
            $table->string('npm');
            $table->double('tugas')->nullable();
            $table->double('uts')->nullable();
            $table->double('uas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};