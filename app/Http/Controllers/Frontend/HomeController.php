<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // artikel terbaru
        $main_post = Article::with('category:id,name', 'user:id,name') // Pastikan 'user' sudah di-load
            ->select('id', 'user_id', 'category_id', 'title', 'slug', 'content', 'published', 'is_confirm', 'views', 'image')
            ->latest()
            ->where('published', true)
            ->where('is_confirm', true)
            ->first();

        // artikel terpopuler
        $top_view = Article::with('category:id,name', 'user:id,name') // Juga load 'user' di sini
            ->select('id', 'user_id', 'category_id', 'title', 'slug', 'content', 'published', 'is_confirm', 'views', 'image')
            ->orderBy('views', 'desc')
            ->where('published', true)
            ->where('is_confirm', true)
            ->first();

        // artikel terbaru semua kategori
        $main_post_all = Article::with('category:id,name', 'user:id,name') // Load 'user' di sini juga
            ->select('id', 'user_id', 'category_id', 'title', 'slug', 'published', 'is_confirm', 'views', 'image')
            ->latest()
            ->where('published', true)
            ->where('is_confirm', true)
            ->where('id', '!=', optional($main_post)->id) // mengabaikan artikel terbaru
            ->limit(6)
            ->get();

        // Artikel terbaru untuk ditampilkan
        $latest_articles = Article::with('category:id,name', 'user:id,name') // Load 'user'
            ->select('id', 'user_id', 'category_id', 'title', 'slug', 'published', 'is_confirm', 'views', 'image', 'created_at')
            ->latest()
            ->where('published', true)
            ->where('is_confirm', true)
            ->get();

        return view('frontend.home.index', [
            'main_post' => $main_post,
            'top_view' => $top_view,
            'main_post_all' => $main_post_all,
            'latest_articles' => $latest_articles,
        ]);
    }
}
