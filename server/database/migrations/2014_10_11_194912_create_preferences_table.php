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
            $table->enum('gender', ['mujer', 'hombre', 'no binario']);$table->enum('looksFor', ['mujeres', 'hombres', 'no binarias','todo']);
            $table->enum('ageRange', ['20-30', '25-35', '35-45', 'no importa']);
            $table->enum('sexoAffective', ['monogama', 'explorar', 'abierta', 'beneficios', 'fluir','casual']);
            $table->enum('heartState', ['maduro', 'solo', 'feliz', 'recuperarse', 'despechado']);
            $table->json('personalValues');
            $table->enum('preferences1', ['netflix', 'eventos', 'gym', 'escapadas', 'todas']);
            $table->enum('preferences2', ['alcohol', 'cafe', 'Refrescos', 'agua', 'ninguna','no alcohol']);
            $table->enum('catsDogs', ['gatos', 'perros', 'todos', 'no gustan']);
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
