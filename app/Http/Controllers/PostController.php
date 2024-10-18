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
                'message' => "No se han encontrado Posts publicados",
                'status' => 404,
            ];
            
            return response()->json($datos, 404);
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

    public function show($id) {
        try {
            $posts = Post::findOrFail($id);

        return response()->json([
            'message' => 'Post obtenido con exito',
            'post' => $posts,
            'status' => 200
        ], 200);

        }catch(ModelNotFoundException $e) {

            return response()->json([
                'message' => 'Post no encontrado',
                'status' => 404
            ], 404);
        }
    }
}
