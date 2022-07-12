<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Resources\Post;
use App\Http\Resources\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetrievePostsTest extends TestCase
{
    use RefreshDatabase;

    public function a_user_can_retrieve_posts()
    {

        $this->withoutExceptionHandling;


        $User = User::factory()->create();
        $Posts = Post::factory()->count(2)->create(['user_id'=>$User->id]);
        $response = $this->get('/api/posts');

        $response->assertStatus(200)
                  ->assertJson([
                      'data'=>[

                      'data'=>[
                          'type'=>'posts',
                          'post_id'=>$Posts->last()->id,
                          'attributes'=>[
                              'body'=>$Posts->last()->body,
                              'image' => url($Posts->last()->image),
                                'posted_at' => $Posts->last()->created_at->diffForHumans(),
                          ]
                          ],
                          'data'=>[
                            'type'=>'posts',
                            'post_id'=>$Posts->first()->id,
                            'attributes'=>[
                                'body'=>$Posts->first()->body,
                                'image' => url($Posts->last()->image),
                                'posted_at' => $Posts->last()->created_at->diffForHumans(),
                            ]
                            ],
                        ],
                      'links'=>[
                          'self'=>url('/posts')
                      ]
                          ]);

    }
    public function a_user_can_only_retrieve_their_posts(){
        $User = User::factory()->create();
        $Posts = Post::factory()->create();
        $response = $this->get('/api/posts');

        $response->assertStatus(200)
        ->assertExactJson([
            'data'=>[],
            'links'=>[
                'self'=>url('/posts')
            ]
            ]);
    }
}
