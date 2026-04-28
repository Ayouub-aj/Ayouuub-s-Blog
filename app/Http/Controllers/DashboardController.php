<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('dashboard.index', compact('articles'));
    }
}
