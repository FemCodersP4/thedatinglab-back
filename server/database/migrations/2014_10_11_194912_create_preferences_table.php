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
        Schema::create('preferences', function (Blueprint $table) {
            $table->id();
            $table->date('birthdate');
            $table->enum('gender', ['mujer', 'hombre', 'no binario']);
            $table->enum('looksFor', ['mujeres', 'hombres', 'no binarias','todo']);
            $table->enum('ageRange', ['20-30', '25-35', '35-45', 'no importa']);
            $table->enum('sexoAffective', ['monogama', 'explorar', 'abierta', 'beneficios', 'fluir','casual']);
            $table->enum('heartState', ['maduro', 'solo', 'feliz', 'recuperarse', 'despechado']);
            $table->enum('hasChildren', ['si', 'no']);
            $table->enum('datesParents', ['si', 'no', 'no sabe']);
            $table->enum('values1', ['amabilidad', 'amistad', 'autenticidad', 'aventura', 'comunicacion', 'conciencia', 'confianza', 'creatividad', 'cuidado', 'desarrollo']);
            $table->enum('values2', ['diversion', 'empatia', 'familia', 'fidelidad', 'generosidad', 'gratitud', 'honestidad', 'humildad', 'integridad', 'inteligencia']);
            $table->enum('values3', ['lealtad', 'libertad', 'optimismo', 'resiliencia', 'respeto', 'responsabilidad', 'afectiva', 'sencillez', 'solidaridad', 'humor', 'valentia']);
            $table->string('rrss', 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferences');
    }
};
