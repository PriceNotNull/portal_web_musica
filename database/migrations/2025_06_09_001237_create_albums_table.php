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
        Schema::create('albumes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->foreignId('artista_id')->constrained()->onDelete('cascade');
        $table->year('año');
        $table->string('imagen')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albumes');
    }
};