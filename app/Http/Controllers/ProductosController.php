<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ProductosModel;

class ProductosController extends Controller{
    const API_BASE_URL = 'https://api.escuelajs.co/api/v1/products';

    public function index(){
        $productos = ProductosModel::all();
        return view('productos.index', compact('productos'));
    }

    public function create(){
        return view('productos.create');
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'required',
            'color' => 'required',
            'imagen' => 'required',
            'stock' => 'required|integer|min:0'
        ]);

        ProductosModel::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'color' => $request->color,
            'imagen' => $request->imagen,
            'stock' => $request->stock
        ]);

        return redirect()->route('productos.create')->with('success', 'Producto registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(ProductosModel $producto){
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, ProductosModel $producto){
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'descripcion' => 'required',
            'color' => 'required',
            'imagen' => 'required',
            'stock' => 'required'
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(ProductosModel $producto){
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
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
        $productos = Http::withoutVerifying()->get(self::API_BASE_URL, [
            'categoryId' => 1
        ])->json() ?? [];
        return view('productos.ropa', compact('productos'));
    }

    public function calzado()
    {
        $productos = Http::withoutVerifying()->get(self::API_BASE_URL, [
            'categoryId' => 4
        ])->json() ?? [];
        return view('productos.calzado', compact('productos'));
    }
}

