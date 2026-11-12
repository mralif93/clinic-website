<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->query('kategori');
        $search = $request->query('carian');

        $query = Article::where('is_published', true);

        if ($category) {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search): void {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $featuredArticle = Article::where('is_published', true)
            ->where('is_featured', true)
            ->latest('published_at')
            ->first();

        $articles = $query->latest('published_at')->paginate(9)->withQueryString();

        $categories = [
            'mental_health' => 'Kesihatan Mental',
            'relationship' => 'Hubungan & Pasangan',
            'parenting' => 'Keibubapaan & Anak',
            'depression' => 'Kemurungan & Stres',
            'wellness' => 'Kesejahteraan Diri',
        ];

        return view('pages.articles.index', [
            'articles' => $articles,
            'featuredArticle' => $featuredArticle,
            'categories' => $categories,
            'currentCategory' => $category,
            'currentSearch' => $search,
        ]);
    }

    public function show(string $slug): View
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Increment view count
        $article->increment('views_count');

        $relatedArticles = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->where(function ($q) use ($article): void {
                $q->where('category', $article->category);
            })
            ->take(3)
            ->get();

        if ($relatedArticles->isEmpty()) {
            $relatedArticles = Article::where('is_published', true)
                ->where('id', '!=', $article->id)
                ->take(3)
                ->get();
        }

        return view('pages.articles.show', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}
