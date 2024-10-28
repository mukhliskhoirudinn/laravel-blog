<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $isOwner = $user->hasRole('owner');
        $isWriter = $user->hasRole('writer');

        if ($isOwner) {
            $totalArticles = Article::count();
            $pendingArticles = Article::where('is_confirm', false)->count();
            $categoryStats = Category::withCount('articles')->get();
        } elseif ($isWriter) {
            $totalArticles = Article::where('user_id', $user->id)->count();
            $pendingArticles = Article::where('user_id', $user->id)
                ->where('is_confirm', false)
                ->count();

            // Mengambil kategori dengan artikel yang dibuat oleh user yang login
            $categoryStats = Category::withCount(['articles' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])->get();
        }

        return view('home', compact('totalArticles', 'pendingArticles', 'categoryStats'));
    }
}
