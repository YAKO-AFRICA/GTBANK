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
        Schema::create('agence_by_parters', function (Blueprint $table) {
            $table->id();
            $table->string('codeAgnce')->nullable();
            $table->string('libelle')->nullable();
            $table->string('codeBanque')->nullable();
            $table->string('codePartner')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agence_by_parters');
    }
};
