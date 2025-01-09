<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function inicio(){
        // Obtén el usuario autenticado
        $user = Auth::user();

        return Inertia::render('Inicio', [
            'user' => $user,  // Asegúrate de pasar el usuario correctamente
        ]);
    }

    public function loadView(){
        $files = [];

        return view('inicio', ["files"=> $files]);
    }

    public function storefile(Request $request){
        
    }

    public function donwloadFile($name){

    }
}
