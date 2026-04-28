<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $articles = $category->articles()
            ->where('status', 'published')
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $categories = Category::all();

        return view('articles.index', [
            'articles' => $articles,
            'categories' => $categories,
            'currentCategory' => $category,
        ]);
    }

    public function index()
    {
        $categories = Category::withCount('articles')->orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255', 'unique:categories,name'],
        ]);

        Category::create($validated);

        return redirect()->route('manage.categories.index')->with('status', 'Category created.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255', 'unique:categories,name,' . $category->id],
        ]);

        $category->update($validated);

        return redirect()->route('manage.categories.index')->with('status', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        // Keep data integrity: do not remove category that still has articles.
        if ($category->articles()->exists()) {
            return back()->withErrors([
                'category' => 'Cannot delete category with existing articles.',
            ]);
        }

        $category->delete();

        return redirect()->route('manage.categories.index')->with('status', 'Category deleted.');
    }
}