<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminArticleTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin@sakeenahmedicare.net',
            'password' => Hash::make('password123'),
        ]);
    }

    public function test_admin_can_view_articles_list(): void
    {
        Article::factory()->create(['title' => 'Post Ujian Pertama']);

        $response = $this->actingAs($this->admin)->get(route('admin.articles.index'));

        $response->assertStatus(200);
        $response->assertSee('Post Ujian Pertama');
    }

    public function test_admin_can_create_new_article_post(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.articles.store'), [
            'title' => 'Cara Menguruskan Serangan Panik',
            'category' => 'mental_health',
            'author_name' => 'CP Tasha',
            'summary' => 'Panduan pantas menenangkan sistem saraf parasimpatetik.',
            'content' => 'Langkah pertama apabila panik menyerang adalah teknik pernafasan 4-7-8.',
            'read_time_minutes' => 5,
            'tags' => 'panic, anxiety, breathing',
            'is_featured' => true,
            'is_published' => true,
        ]);

        $response->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseHas('articles', [
            'title' => 'Cara Menguruskan Serangan Panik',
            'author_name' => 'CP Tasha',
            'is_featured' => true,
            'is_published' => true,
        ]);
    }

    public function test_admin_can_update_article(): void
    {
        $article = Article::factory()->create([
            'title' => 'Tajuk Asal',
        ]);

        $response = $this->actingAs($this->admin)->put(route('admin.articles.update', $article->id), [
            'title' => 'Tajuk Baru Yang Dikemaskini',
            'category' => 'wellness',
            'author_name' => 'CP Naziah',
            'content' => 'Kandungan baru...',
            'read_time_minutes' => 4,
            'is_published' => true,
        ]);

        $response->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'Tajuk Baru Yang Dikemaskini',
        ]);
    }

    public function test_admin_can_delete_article(): void
    {
        $article = Article::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.articles.destroy', $article->id));

        $response->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
        ]);
    }

    public function test_public_article_views_count_increments(): void
    {
        $article = Article::factory()->create([
            'views_count' => 0,
            'is_published' => true,
        ]);

        $this->get(route('articles.show', $article->slug));

        $this->assertEquals(1, $article->fresh()->views_count);
    }
}
