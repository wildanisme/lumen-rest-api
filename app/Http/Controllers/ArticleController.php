<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
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
      $articles = Article::with('category')->get();

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
            'data' => "Data tidak ditemukan!"
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

    public function update(Request $request, $id)
    {
      $article = Article::whereId($id);

      if(!$article){
        return response()->json([
          'message' => 'Data tidak ditemukan'
        ], 404);
      }

      $this->validate($request, [
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

      $article->update([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'category_id' => $request->input('category_id'),
      ]);

      return response()->json([
        'message' => 'Data berhasil diupdate!'
      ], 200);
    }

    public function destroy($id)
    {
      $article = Article::find($id);
      $article->delete();

      return response()->json([
        'message' => 'Data berhasil dihapus!'
      ], 200);
    }
}
