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
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_matakuliah')->constrained('matakuliahs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('soal');
            $table->text('kunci');
            $table->integer('bobot');
            $table->enum('kesulitan', ['Mudah', 'Sedang', 'Sulit'])->default('Mudah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
