<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');
        $category = $request->query('category');
        $status = $request->query('status'); // published, draft

        $query = Article::query();

        if ($search) {
            $query->where(function ($q) use ($search): void {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author_name', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        if ($status !== null && $status !== '') {
            $query->where('is_published', $status === 'published');
        }

        $articles = $query->latest('created_at')->paginate(12)->withQueryString();

        $categories = Article::distinct()->pluck('category')->filter()->values();

        return view('admin.articles.index', [
            'articles' => $articles,
            'search' => $search,
            'selectedCategory' => $category,
            'selectedStatus' => $status,
            'categories' => $categories,
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
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'read_time_minutes' => ['required', 'integer', 'min:1'],
            'tags' => ['nullable', 'string'],
            'is_published' => ['boolean'],
            'is_featured' => ['boolean'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $validated['image_path'] = 'storage/'.$path;
        }

        $validated['slug'] = Str::slug($validated['title']).'-'.Str::random(4);
        $validated['tags'] = array_filter(array_map('trim', explode(',', $request->input('tags', ''))));
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel baharu berjaya diterbitkan.');
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
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'read_time_minutes' => ['required', 'integer', 'min:1'],
            'tags' => ['nullable', 'string'],
            'is_published' => ['boolean'],
            'is_featured' => ['boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($article->image_path && Str::startsWith($article->image_path, 'storage/')) {
                $rawPath = Str::after($article->image_path, 'storage/');
                if (Storage::disk('public')->exists($rawPath)) {
                    Storage::disk('public')->delete($rawPath);
                }
            }
            $path = $request->file('image')->store('articles', 'public');
            $validated['image_path'] = 'storage/'.$path;
        }

        $validated['tags'] = array_filter(array_map('trim', explode(',', $request->input('tags', ''))));
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['is_published'] && ! $article->published_at) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berjaya dikemaskini.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel telah dipadam.');
    }
}
