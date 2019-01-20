<?php

namespace Tests\Feature;

use App\Models\Blog;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Yarmat\Comment\Models\Comment;

class CommentTest extends TestCase
{
    use WithFaker;

    public function test_store()
    {
        $blog = Blog::first();
        $response = $this->post(route('comment.store'), [
            'model' => Blog::class,
            'id' => $blog->id,
            'message' => $this->faker->realText(100),
            'parent_id' => 0,
            'name' => $this->faker->firstName,
            'email' => $this->faker->email
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['success', 'message', 'comment']);
    }

    public function test_store_auth()
    {
        $blog = Blog::first();
        $response = $this->auth()->post(route('comment.store'), [
            'model' => Blog::class,
            'id' => $blog->id,
            'message' => $this->faker->realText(100),
            'parent_id' => 0,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['success', 'message', 'comment']);
    }

    public function test_delete()
    {
        $comment = (Blog::first())->saveComment([
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'message' => $this->faker->realText(100),
            'parent_id' => 0
        ]);

        $response = $this->auth()->post(route('comment.destroy'), [
            'id' => $comment->id
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure(['success', 'message']);
    }

    public function test_update()
    {

        $comment = (Blog::first())->saveComment([
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'message' => $this->faker->realText(100),
            'parent_id' => 0
        ]);

        $response = $this->post(route('comment.update'), [
            'id' => $comment->id,
            'message' => $this->faker->realText(100)
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure(['success', 'message']);

    }
}
