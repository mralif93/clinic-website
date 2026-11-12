<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');
        $query = Article::query();

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author_name', 'like', "%{$search}%");
        }

        $articles = $query->latest('created_at')->paginate(12)->withQueryString();

        return view('admin.articles.index', [
            'articles' => $articles,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return view('admin.articles.form', [
            'article' => new Article,
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'author_name' => ['required', 'string', 'max:255'],
            'summary' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'read_time_minutes' => ['required', 'integer', 'min:1'],
            'tags' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'is_published' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['title']).'-'.Str::random(4);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        if (! empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel / Post baharu berjaya diterbitkan.');
    }

    public function edit(int $id): View
    {
        $article = Article::findOrFail($id);

        return view('admin.articles.form', [
            'article' => $article,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'author_name' => ['required', 'string', 'max:255'],
            'summary' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'read_time_minutes' => ['required', 'integer', 'min:1'],
            'tags' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'is_published' => ['boolean'],
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');

        if ($validated['is_published'] && ! $article->published_at) {
            $validated['published_at'] = now();
        }

        if (! empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel / Post berjaya dikemaskini.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel telah dipadam.');
    }
}
