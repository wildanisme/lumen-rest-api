<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
      $articles = Article::all();

      return response()->json([
        'message' => "List Artikel",
        'data' => $articles
      ], 200);
    }

    public function show($id)
    {
      $article = Article::whereId($id)->first();

      if($article){
        return response()->json([
          'message' => "Artikel berdasarkan ID",
          'data' => $article
        ], 200);
      }else{
          return response()->json([
            'message' => "Artikel berdasarkan ID",
            'data' => "Tidak ada data"
          ], 404);
      }
    }

    public function store(Request $request)
    {
      $validatedData = $this->validate($request, [
        'title' => 'required|min:5',
        'content' => 'required|min:10',
        'category_id' => 'required|numeric'
        ],
        [
          'title.required' => 'Judul tidak boleh kosong!',
          'content.required' => 'Konten tidak boleh kosong!',
          'content.min' => 'Konten Minimal 10 kata!',
          'category_id.required' => 'Kategori tidak boleh kosong!',
          'category_id.numeric' => 'Kategori harus berisi angka!',
        ]
      );

      Article::create($validatedData);

      return response()->json([
        'message' => 'Data berhasil ditambah'
      ], 200);
    }
}
