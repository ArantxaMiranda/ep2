<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductosModel;

class ProductosController extends Controller
{
    /**
     * CONSULTA DE INFORMACIÓN
     */
    public function index()
    {
        $productos = ProductosModel::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * GUARDAR INFORMACIÓN EN LA BD
     */
    public function store(Request $request)
    {
        ProductosModel::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'color' => $request->color,
            'imagen' => $request->imagen,
            'stock' => $request->stock
        ]);

        return redirect()->route('productos.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * CONSULTA POR ID
     */
    public function edit(ProductosModel $producto){
        return view('productos.edit', compact('producto'));
    }

    /**
     * ACTUALIZAR PRODUCTO
     */
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

        return redirect()->route('productos.index');
    }

    /**
     * ELIMINAR PRODUCTO
     */
    public function destroy(ProductosModel $producto){
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}