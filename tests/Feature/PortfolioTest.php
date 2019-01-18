<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Portfolio;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PortfolioTest extends TestCase
{

    public function test_visit_index()
    {
        $response = $this->get(route('portfolio.index'));
        $response->assertStatus(200);
    }

    public function test_visit_show()
    {
        $item = Portfolio::first();
        $response = $this->get(route('portfolio.show', $item->slug));
        $response->assertStatus(200);
        $response->assertSee($item->title);
    }

    public function test_visit_show_invalid()
    {
        $response = $this->get(route('portfolio.show', 'not_found'));
        $response->assertStatus(404);
    }

    public function test_load()
    {
        $response = $this->ajaxPost(route('portfolio.load'), [
            'page' => 2
        ]);

        $response->assertJsonStructure(['success', 'message', 'items', 'more_btn']);
    }

    public function test_load_invalid()
    {

        $response = $this->post(route('portfolio.load'), [
            'page' => 2
        ]);

        $response->assertStatus(405);

        $response = $this->get(route('portfolio.load'), [
            'page' => 2
        ]);

        $response->assertStatus(404);
    }

    public function test_visit_category()
    {
        $category = Category::whereHas('portfolios')->first();

        $response = $this->get(route('portfolio.category.show', $category->slug));

        $response->assertStatus(200);

        $response->assertSee($category->title);
    }

    public function test_visit_category_invalid()
    {
        $response = $this->get(route('portfolio.category.show', 'not-found'));

        $response->assertStatus(404);
    }

    public function test_category_load()
    {
        $category = Category::first();

        $response = $this->ajaxPost(route('portfolio.category.load', $category->slug), [
            'page' => 2
        ]);

        $response->assertJsonStructure(['success', 'message', 'items', 'more_btn']);
    }

    public function test_category_load_invalid()
    {
        $category = Category::first();

        $response = $this->post(route('portfolio.category.load', $category->slug), [
            'page' => 2
        ]);

        $response->assertStatus(405);

        $response = $this->get(route('portfolio.category.load', $category->slug), [
            'page' => 2
        ]);

        $response->assertStatus(405);
    }
}
