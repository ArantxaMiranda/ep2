<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\ProductosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritosController extends Controller
{
    public function index()
    {
        $favoritos = Favorito::where('user_id', Auth::id())->with('producto')->get();
        return view('ventas.favoritos', compact('favoritos'));
    }

    public function store(Request $request)
    {
        // El id que mandan puede ser el api_id
        $api_id = $request->api_id;
        $producto = ProductosModel::where('api_id', $api_id)->first();

        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        // Evitar duplicados
        $existe = Favorito::where('user_id', Auth::id())
                          ->where('producto_id', $producto->id)
                          ->first();

        if ($existe) {
            return redirect()->back()->with('info', 'El producto ya está en tus favoritos.');
        }

        Favorito::create([
            'user_id' => Auth::id(),
            'producto_id' => $producto->id,
        ]);

        return redirect()->back()->with('success', 'Producto añadido a favoritos.');
    }

    public function destroy($id)
    {
        $favorito = Favorito::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $favorito->delete();

        return redirect()->back()->with('success', 'Producto eliminado de favoritos.');
    }
}
