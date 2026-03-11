<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm(){
        return view('auth.register');
    }

    // Metodo para guardar la informacion en la base de datos
    public function register(Request $request){
        // Recabar la información desde el formulario
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed|min: 8',
    ]);

        // Guardar la información en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin'),
            // Uso de has() para el manejo del checkbox
        ]);

        //Iniciar sesión de forma automática
        Auth::login($user);

        return redirect()->route('productos.index')->with('success', '¡Registro exitoso! Bienvenido ' . $user->name);

    }

    // Método para regresar vista de inicio de sesión
    public function loginForm(){
        return view('auth.login');
    }

    // Método para iniciar sesión
    public function login(Request $request){

    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Realizar intento de inicio de sesión
    if(Auth::attempt($data)){
        // Obtener información de la sesión y generar sus credenciales
        $request -> session()->regenerate();
        // Redireccionar al usuario con su sesión iniciada
        return redirect()->route('productos.index')->with('success', '¡Bienvenido de nuevo!');
    }

    // Si los datos son incorrectos, mandar un error
    return back()->with('error', 'Credenciales incorrectas. Por favor, verifica tu correo y contraseña.');

    }

    // Método para cerrar sesión e invalidar las credenciales
    public function logout(Request $request){
       
        // Cerrar sesión
        Auth::logout();
        
        // Cierre de credenciales en las sesiones
        $request -> session() -> invalidate();
        $request -> session() -> regenerateToken();

        return redirect('/acceso')->with('info', 'Has cerrado sesión correctamente');

    }

    // Panel principal del administrador
    public function adminDashboard(){
        return view('admin.dashboard');
    }
}
