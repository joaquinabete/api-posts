<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    
    public function index() {
        $posts = Post::all();
        
        if($posts->isEmpty()) {
            $datos = [
                'message' => "No se han encontrado posts publicados",
                'status' => 200,
            ];
            
            return response()->json($datos, 200);
        }
        return response()->json($posts, 200);
    }
    
    public function store(Request $request) {

        $validarDatos = $request->validate([
            'id_autor' => 'required|integer',
            'titulo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'contenido' => 'required|string',
        ]);
        
        $posts = Post::create([
            'id_autor' => $validarDatos['id_autor'],
            'titulo' => $validarDatos['titulo'],
            'fecha' => $validarDatos['fecha'],
            'contenido' => $validarDatos['contenido'], 
        ]);
        return response()->json($posts, 201);

    }


}
