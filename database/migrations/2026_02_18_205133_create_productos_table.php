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
        Schema::create('productos', function (Blueprint $table) {
            // Campos a crear de la tabla en la BD
            $table->id();
            $table->string('nombre');
            $table->decimal('precio');
            $table->text('descripcion');   
            $table->string('color');
            $table->string('imagen')->nullable();
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table -> dropColumn('phone');
        });
    }
};
