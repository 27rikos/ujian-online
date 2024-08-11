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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_matkul')->constrained('matakuliahs')->cascadeOnDelete();
            $table->string('nama');
            $table->string('nim');
            $table->string('jenis_ujian');
            $table->text('jawaban1')->nullable();
            $table->text('jawaban2')->nullable();
            $table->text('jawaban3')->nullable();
            $table->text('jawaban4')->nullable();
            $table->text('jawaban5')->nullable();
            $table->double('nilai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};