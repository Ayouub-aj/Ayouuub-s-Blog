<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
                           ->where('status', 'published')
                           ->latest()
                           ->get();

        $categories = Category::all();

        return view('articles.index', compact('articles', 'categories'));
    }

    public function show($id)
    {
        $article = Article::with('category')
                          ->where('status', 'published')
                          ->findOrFail($id);

        return view('articles.show', compact('article'));
    }
}