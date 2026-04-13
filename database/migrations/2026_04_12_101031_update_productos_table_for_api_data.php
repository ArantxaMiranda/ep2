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
        Schema::table('productos', function (Blueprint $table) {
            $table->integer('api_id')->nullable()->unique()->after('id');
            $table->string('categoria')->nullable()->change();
            $table->text('imagen')->nullable()->change();
            $table->decimal('precio', 10, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('api_id');
            $table->string('categoria')->nullable(false)->change();
            $table->string('imagen')->nullable(false)->change();
            $table->decimal('precio', 8, 2)->change();
        });
    }
};
