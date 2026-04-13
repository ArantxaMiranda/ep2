<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ProductosModel;

class ProductosController extends Controller{
    const API_BASE_URL = 'https://api.escuelajs.co/api/v1/products';

    public function index(){
        $productos = ProductosModel::all();
        return view('admin.consultarproductos', compact('productos'));
    }

    public function create(){
        return view('admin.createproducto');
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'required',
            'categoria' => 'required',
            'imagen' => 'required',
            'stock' => 'required|integer|min:0'
        ]);

        ProductosModel::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'imagen' => $request->imagen,
            'stock' => $request->stock
        ]);

        return redirect()->route('admin.productos.create')->with('success', 'Producto registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(ProductosModel $producto){
        return view('admin.editproducto', compact('producto'));
    }

    public function update(Request $request, ProductosModel $producto){
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required',
            'imagen' => 'required',
            'stock' => 'required'
        ]);

        $producto->update($request->all());

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(ProductosModel $producto){
        $producto->delete();
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado correctamente');
    }

    public function importar(){
        $productosApi = Http::withoutVerifying()->get(self::API_BASE_URL)->json() ?? [];

        foreach($productosApi as $item){
            ProductosModel::updateOrCreate(
                ['nombre' => $item['title']],
                [
                    'precio' => $item['price'],
                    'descripcion' => $item['description'],
                    'categoria' => $item['category']['name'] ?? 'Sin categoría',
                    'imagen' => $item['images'][0] ?? 'https://via.placeholder.com/150',
                    'stock' => rand(10, 100)
                ]
            );
        }

        return redirect()->route('admin.productos.index')->with('success', 'Productos importados/sincronizados correctamente');
    }

    public function home(){
        // Sección de Ropa (Clothes)
        $ropa = Http::withoutVerifying()->get(self::API_BASE_URL, [
            'categoryId' => 1,
            'limit' => 10,
        ])->json() ?? [];

        $ropa = array_slice($ropa, 0, 10);

        // Sección de Zapatos o Accesorios (Shoes)
        $accesorios = Http::withoutVerifying()->get(self::API_BASE_URL, [
            'categoryId' => 4,
            'limit' => 10,
        ])->json() ?? [];

        $accesorios = array_slice($accesorios, 0, 10);

        return view('productos.home', compact('ropa', 'accesorios'));
    }

    public function catalogo()
    {
        $productos = Http::withoutVerifying()->get(self::API_BASE_URL)->json() ?? [];
        return view('productos.catalogocompleto', compact('productos'));
    }

    public function ropa()
    {
        $ropa = Http::withoutVerifying()->get(self::API_BASE_URL, [
            'categoryId' => 1,
            'limit' => 20,
        ])->json() ?? [];

        return view('productos.ropa', compact('ropa'));
    }

    public function calzado()
    {
        $calzado = Http::withoutVerifying()->get(self::API_BASE_URL, [
            'categoryId' => 4,
            'limit' => 20,
        ])->json() ?? [];

        return view('productos.calzado', compact('calzado'));
    }

    public function importarDesdeAPI()
    {
        $response = Http::withoutVerifying()->get(self::API_BASE_URL);
        
        if ($response->successful()) {
            $productosAPI = $response->json();
            $importados = 0;

            foreach ($productosAPI as $item) {
                // Usamos updateOrCreate para evitar duplicados basados en api_id
                ProductosModel::updateOrCreate(
                    ['api_id' => $item['id']],
                    [
                        'nombre'      => $item['title'],
                        'precio'      => $item['price'],
                        'descripcion' => $item['description'],
                        'categoria'   => $item['category']['name'] ?? 'General',
                        'imagen'      => $item['images'][0] ?? null,
                        'stock'       => rand(10, 50), // Stock aleatorio inicial
                    ]
                );
                $importados++;
            }

            return redirect()->route('productos.index')
                ->with('success', "Se han importado/actualizado $importados productos correctamente desde la API.");
        }

        return redirect()->back()->with('error', 'No se pudo conectar con la API de productos.');
    }
}

