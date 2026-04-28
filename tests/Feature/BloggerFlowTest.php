<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BloggerFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_blogger_full_management_flow_works(): void
    {
        $user = User::where('email', 'blogger@blog.com')->firstOrFail();
        $category = Category::firstOrFail();

        $this->post(route('login.submit'), [
            'email' => 'blogger@blog.com',
            'password' => 'password',
        ])->assertRedirect(route('dashboard.index'));

        $this->actingAs($user)
            ->get(route('dashboard.index'))
            ->assertOk();

        $this->actingAs($user)
            ->post(route('articles.store'), [
                'title' => 'New Draft Post',
                'content' => 'This is a draft article body.',
                'category_id' => $category->id,
                'status' => 'draft',
            ])->assertRedirect(route('dashboard.index'));

        $article = Article::where('title', 'New Draft Post')->firstOrFail();

        $this->actingAs($user)
            ->put(route('articles.update', $article), [
                'title' => 'New Published Post',
                'content' => 'Updated and ready to publish.',
                'category_id' => $category->id,
                'status' => 'published',
            ])->assertRedirect(route('dashboard.index'));

        $article->refresh();
        $this->assertSame('published', $article->status);

        $this->actingAs($user)
            ->delete(route('articles.destroy', $article))
            ->assertRedirect(route('dashboard.index'));

        $this->assertDatabaseMissing('articles', ['id' => $article->id]);

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('articles.index'));
    }
}
