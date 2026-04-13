<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crear el administrador inicial
        User::updateOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name'     => 'admin',
                'phone'    => '1234567890',
                'password' => '$2y$12$eHkI60MBPLmvxmDAl28nr.KdXi8rONgnRTAZ5XzXQMXu9L1KYD8yW',
                'is_admin' => 1,
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::where('email', 'admin@test.com')->delete();
    }
};
