<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;
use App\Models\ProductosModel;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            $url = 'https://api.escuelajs.co/api/v1/products';
            
            $response = Http::withoutVerifying()->get($url);
            
            if ($response->successful()) {
                $productosAPI = $response->json();

                foreach ($productosAPI as $item) {
                    if (isset($item['id'], $item['title'], $item['price'])) {
                        ProductosModel::updateOrCreate(
                            ['api_id' => $item['id']],
                            [
                                'nombre'      => $item['title'],
                                'precio'      => $item['price'],
                                'descripcion' => $item['description'] ?? 'Sin descripción',
                                'categoria'   => $item['category']['name'] ?? 'General',
                                'imagen'      => $item['images'][0] ?? null,
                                'stock'       => rand(10, 100),
                            ]
                        );
                    }
                }
            }
        } catch (\Exception $e) {
            \Log::error("Fallo la auto-importación desde la migración: " . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        ProductosModel::whereNotNull('api_id')->delete();
    }
};
