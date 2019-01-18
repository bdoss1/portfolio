<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
{
    public function test_visit_index()
    {
        $response = $this->get(route('blog.index'));
        $response->assertStatus(200);
        $response->assertSee(__('custom.blog'));
    }

    public function test_visit_show()
    {
        $item = Blog::first();

        $response = $this->get(route('blog.show', $item->slug));

        $response->assertStatus(200);

        $response->assertSee($item->title);
    }

    public function test_visit_show_invalid()
    {
        $response = $this->get(route('blog.show', 'not-found'));

        $response->assertStatus(404);
    }

    public function test_visit_category()
    {
        $category = Category::whereHas('blogs')->first();

        $response = $this->get(route('blog.category.show', $category->slug));

        $response->assertStatus(200);

        $response->assertSee($category->title);
    }

    public function test_visit_category_invalid()
    {
        $response = $this->get(route('blog.category.show', 'not-found'));

        $response->assertStatus(404);
    }

    public function test_load()
    {
        $response = $this->ajaxPost(route('blog.load'), [
            'page' => 2
        ]);

        $response->assertJsonStructure(['success', 'message', 'items', 'more_btn']);
    }

    public function test_load_invalid()
    {
        $response = $this->post(route('blog.load'), [
            'page' => 2
        ]);

        $response->assertStatus(405);

        $response = $this->get(route('blog.load'), [
            'page' => 2
        ]);

        $response->assertStatus(404);
    }

    public function test_category_load()
    {
        $category = Category::whereHas('blogs')->first();

        $response = $this->ajaxPost(route('blog.category.load', $category->slug), [
            'page' => 2
        ]);

        $response->assertJsonStructure(['success', 'message', 'items', 'more_btn']);
    }

    public function test_category_load_invalid()
    {
        $response = $this->ajaxPost(route('blog.category.load', 'not-found'), [
            'page' => 2
        ]);

        $response->assertStatus(404);

        $response = $this->post(route('blog.category.load', 'not-found'), [
            'page' => 2
        ]);

        $response->assertStatus(405);

        $response = $this->get(route('blog.category.load', 'not-found'), [
            'page' => 2
        ]);

        $response->assertStatus(405);
    }

}
