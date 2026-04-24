<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);

        $articles = $category->articles()
                             ->where('status', 'published')
                             ->latest()
                             ->get();

        $categories = Category::all();

        return view('articles.index', compact('articles', 'categories', 'category'));
    }
}