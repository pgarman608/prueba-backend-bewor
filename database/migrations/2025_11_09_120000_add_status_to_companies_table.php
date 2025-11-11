<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Correr las migraciones.
     * Añadir el campo status a la tabla companies y comprobar que 
     * funciona creando una compañia de prueba.
     * @return void
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // inactive = DISABLED by default to match domain value object
            $table->string('status')->default("inactive");
            // Create a company with random data to test activation
            $faker = \Faker\Factory::create();
            DB::table('companies')->insert([
                'id' => (string) Str::uuid(),
                'name' => $faker->name,
                'email' => $faker->email,
                'address' => $faker->address
            ]);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
