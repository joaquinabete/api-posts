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
        $posts = Post::find($id);

        if(!$posts) {
            $datos = [
                'message' => "Hay mas de un Post publicado",
                'status' => 404
            ];
            return response()->json($datos,404);
        }

        $datos = [
            'message' => 'Se ha obtenido el Post correctamente',
            'status' => 200,
            'posts' => $posts
        ];
        return response()->json($datos, 200);
    }
}
