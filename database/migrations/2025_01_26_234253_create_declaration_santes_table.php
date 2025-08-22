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
        Schema::create('declaration_santes', function (Blueprint $table) {
            $table->id();
            $table->integer('taille')->nullable();
            $table->integer('poids')->nullable();
            $table->integer('tensionMin')->nullable();
            $table->integer('tensionMax')->nullable();
            $table->string('smoking')->nullable();
            $table->string('alcohol')->nullable();
            $table->string('sport')->nullable();
            $table->string('accident')->nullable();
            $table->string('treatment')->nullable();
            $table->string('transSang')->nullable();
            $table->string('interChirugiale')->nullable();
            $table->string('prochaineInterChirugiale')->nullable();
            $table->string('diabetes')->nullable();
            $table->string('hypertension')->nullable();
            $table->string('sickleCell')->nullable();
            $table->string('liverCirrhosis')->nullable();
            $table->string('lungDisease')->nullable();
            $table->string('cancer')->nullable();
            $table->string('anemia')->nullable();
            $table->string('kidneyFailure')->nullable();
            $table->string('stroke')->nullable();
            $table->string('codePret')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declaration_santes');
    }
};
