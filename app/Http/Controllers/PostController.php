<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    
    public function index() {
        $posts = Post::all();

        if ($posts->isEmpty()) {
            return response()->json([
            'message' => 'No se encontro ningun Post publicado',
            'status' => 404            
        ], 404);
        
        }

        return response()->json([
            'message' => 'Todos los Posts han sido obtenidos exitosamente',
            'status' => 200,
            'posts' => $posts
        ], 200);
    }
    
    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
            'titulo' => 'required|max:value:30|alpha',
            'fecha' => 'required|date_format:Y-m-d',
            'contenido' => 'required|string|min:15|max:180'
        ]);

        if($validator->fails())
            return $validator->errors();

        $posts = Post::create([
            'id_autor' => $request-> id_autor,
            'titulo' => $request-> titulo,
            'fecha' => $request -> fecha,
            'contenido' => $request -> contenido, 
        ]);
        return response()->json(['message' => 'Post creado exitosamente', 'post' => $posts], 201);
    }

    public function show($id) {
        try {
            $posts = Post::findOrFail($id);

        return response()->json([
            'message' => 'Post obtenido con exito',
            'status' => 200,
            'post' => $posts
        ], 200);

        }catch(ModelNotFoundException $e) {

            return response()->json([
                'message' => 'Post no encontrado',
                'status' => 404
            ], 404);
        }
    }
}
