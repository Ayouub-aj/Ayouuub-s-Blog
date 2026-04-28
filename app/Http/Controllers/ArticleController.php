<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
                           ->where('status', 'published')
                           ->latest()
                           ->paginate(6);

        $categories = Category::orderBy('name')->get();

        return view('articles.index', compact('articles', 'categories'));
    }

    public function show($id)
    {
        $article = Article::with('category')
                          ->where('status', 'published')
                          ->findOrFail($id);

        return view('articles.show', compact('article'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'in:draft,published'],
        ]);

        Article::create($validated + ['user_id' => Auth::id()]);

        return redirect()->route('dashboard.index')->with('status', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        abort_unless($article->user_id === Auth::id(), 403);

        $categories = Category::orderBy('name')->get();

        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        abort_unless($article->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $article->update($validated);

        return redirect()->route('dashboard.index')->with('status', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        abort_unless($article->user_id === Auth::id(), 403);

        $article->delete();

        return redirect()->route('dashboard.index')->with('status', 'Article deleted successfully.');
    }
}