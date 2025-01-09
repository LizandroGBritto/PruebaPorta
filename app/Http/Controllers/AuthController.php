<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Mostrar la vista de registro.
     */
    function registro()
    {
        return inertia::render('Registro');
    }

    /**
     * Manejar el envío del formulario de registro.
     */
    function registroPost(Request $request)
    {
        // Validar los datos enviados en el formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'telefono' => 'required|string|min:10|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'imagen_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Máximo 2MB
        ]);

        // Manejar la carga de la imagen si existe
        $imagenPerfilPath = null;
        if ($request->hasFile('imagen_perfil')) {
            $imagenPerfilPath = $request->file('imagen_perfil')->store('imagenes_perfil', 'public');
        }

        // Crear el usuario en la base de datos 
        User::create([
            'name' => $request->name,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'imagen_perfil' => $imagenPerfilPath,
        ]);

        return response()->json(['success' => true, 'message' => 'Usuario registrado correctamente.']);


    }
    function login()
    {
        return inertia::render('Login');
    }
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();
            $user->update([
                'ultima_sesion' => now(),
            ]);
           
            
            return response()->json([], 200);
           
        }
        return response()->json([], 401);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
