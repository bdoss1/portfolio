<?php

namespace Tests\Feature;

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

    public function test_visit_view()
    {
        $item = Portfolio::first();
        $response = $this->get(route('portfolio.show', $item->slug));
        $response->assertStatus(200);
        $response->assertSee($item->title);
    }

    public function test_load_more()
    {
        $response = $this->post(route('portfolio.load', 2));
        $response->assertJsonStructure(['success', 'message', 'items']);
    }
}
