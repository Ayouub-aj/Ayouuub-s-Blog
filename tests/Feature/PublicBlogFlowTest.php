<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicBlogFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_visitor_can_browse_public_articles_and_filter_by_category(): void
    {
        $published = Article::where('status', 'published')->firstOrFail();

        $this->get(route('articles.index'))
            ->assertOk()
            ->assertSee($published->title);

        $this->get(route('categories.show', $published->category_id))
            ->assertOk()
            ->assertSee($published->title);

        $this->get(route('articles.show', $published->id))
            ->assertOk()
            ->assertSee($published->title)
            ->assertSee($published->content);
    }

    public function test_drafts_are_hidden_publicly_and_create_route_requires_login(): void
    {
        $draft = Article::where('status', 'draft')->firstOrFail();

        $this->get(route('articles.index'))
            ->assertOk()
            ->assertDontSee($draft->title);

        $this->get(route('articles.show', $draft->id))
            ->assertNotFound();

        $this->get(route('articles.create'))
            ->assertRedirect(route('login'));
    }
}
