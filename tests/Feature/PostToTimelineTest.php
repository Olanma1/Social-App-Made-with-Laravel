<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostToTimelineTest extends TestCase
{
use RefreshDatabase;


    public function a_user_can_post_a_text_post()
    {

        $this->withExceptionHandling;

        $User = User::factory()->create();
        $response = $this->post('/api/posts',[
            'data' => [
                'type' => 'posts',
                'attributes' => [
                    'body' => 'Testing Body',
                ]
            ]


        ]);

        $Post = Post::first();

        $this->assertCount(1, Post::all());
        $this->assertEquals($User->id, $Post->User_id);
        $this->assertEquals('Testing Body', $Post->body);
        $response->assertStatus(201)

        ->assertJson([
            'data'=> [
                'type' => 'posts',
                'post_id' => $Post->id,
                'attributes' => [
                    'posted_by'=> [
                        'data'=>[
                            'attributes'=>[
                                'name'=> $User->name,
                            ]
                        ]
                            ],
                    'body' => 'Testing Body',
                ]
                ],

                'links' =>[
                    'self' =>url('/posts/'. $Post->id),
                ]
                ]);


    }
    public function test_user_can_post_a_text_post_with_an_image()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::class()->create(), 'api');


        $file = UploadedFile::fake()->image('user-post.jpg');

        $response = $this->post('/api/posts', [
            'body' => 'Testing Body',
            'image' => $file,
            'width' => 100,
            'height' => 100,
        ]);

        //Storage::disk('public')->assertExist('post-images/'.$file->hashName());
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'attributes' => [
                        'body' => 'Testing Body',
                        'image' => url('post-images/'.$file->hashName()),
                    ]
                ],
            ]);
    }
}

