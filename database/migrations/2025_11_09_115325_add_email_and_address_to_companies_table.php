<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Correr las migraciones.
     * Añadir los campos email y address a la tabla companies.
     * @return void
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string("email")->default("asd");
            $table->string("address")->default("asd");
        });
    }
    /**
     * Revertir las migraciones.
     * Eliminar los campos email y address de la tabla companies.
     * @return void
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['email','address']);
        });
    }
};
