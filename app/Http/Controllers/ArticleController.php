<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        return view('pages.articles.index', [
            'articles' => $articles,
        ]);
    }

    public function show(string $slug): View
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $relatedArticles = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->take(3)
            ->get();

        return view('pages.articles.show', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}
