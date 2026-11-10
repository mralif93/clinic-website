<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_articles_index_and_detail(): void
    {
        $article = Article::factory()->create([
            'title' => 'Panduan Menangani Tekanan Emosi',
            'slug' => 'panduan-menangani-tekanan-emosi',
            'is_published' => true,
        ]);

        $indexResponse = $this->get(route('articles.index'));
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Panduan Menangani Tekanan Emosi');

        $detailResponse = $this->get(route('articles.show', $article->slug));
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee('Panduan Menangani Tekanan Emosi');
    }
}
