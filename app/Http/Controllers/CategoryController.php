<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function createCategory(Request $request)
    {
        $category = new Category();
        $input = $request->all();
        $category->fill($input);
        $category->save();
        $categoryResponse = Category::find($category->id);
        return response()->json($categoryResponse);
    }

    public function updateCategory(Request $request,$id)
    {
        $category = Category::find($id);
        $input = $request->all();
        $category->fill($input);
        $category->save();
        $categoryResponse = Category::find($category->id);
        return response()->json($categoryResponse);
    }

    public function fetchallCategory()
    {
        $category = Category::all();
        return response()->json($category);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();

    }


}
