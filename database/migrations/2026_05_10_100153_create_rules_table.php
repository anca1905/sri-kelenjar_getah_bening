<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyakit_id')->constrained('penyakits')->onDelete('cascade');
            $table->foreignId('gejala_id')->constrained('gejalas')->onDelete('cascade');
            $table->decimal('mb', 3, 2)->default(0); // Measure of Belief (0–1)
            $table->decimal('md', 3, 2)->default(0); // Measure of Disbelief (0–1)
            $table->decimal('cf_pakar', 4, 3)->storedAs('mb - md'); // CF = MB - MD (computed)
            $table->timestamps();

            $table->unique(['penyakit_id', 'gejala_id']); // Satu rule per pasangan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
