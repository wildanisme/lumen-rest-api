<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{

  public function index()
  {
    $categories = Category::all();

    return response()->json([
      'message' => 'Data kategori',
      'data' => $categories,
    ], 200);
  }

  public function show($id)
  {
    $category = Category::whereId($id)->first();
    if(!$category)
    {
      return response()->json([
        'message' => 'Data kategori',
        'data' => 'Data tidak ditemukan',
      ], 404);
    }
    return response()->json([
      'message' => 'Data kategori',
      'data' => $category,
    ], 200);
  }

  public function store(Request $request)
  {
    $validatedData = $this->validate($request, [
      'name' => ['required', 'string']
    ],
      [
        'name.required' => 'Tidak boleh kosong!',
      ]
    );

    Category::create($validatedData);

    return response()->json([
      'message' => 'Data berhasil ditambah'
    ], 200);
  }

  public function update(Request $request, $id)
  {
    $category = Category::whereId($id);

    if(!$category){
      return response()->json([
        'message' => 'Data tidak ditemukan!'
      ], 404);
    }

    $this->validate($request, [
        'name' => ['required']
      ],
        [
          'name.required' => 'Tidak boleh kosong!'
        ]
    );

    return response()->json([
      'message' => 'Data berhasil diupdate'    
    ], 200);

  }

  public function destroy($id)
  {
    $category = Category::whereId($id);
    $category->delete();

    return response()->json([
      'message' => 'Data berhasil dihapus!'
    ], 200);
  }

}