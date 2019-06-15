<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase {

    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_user_can_browse_threads() {
        //with
        $thread = factory('App\Thread')->create();
        //when
        $response = $this->get('/threads');
        //then
        $response->assertStatus(200);
        $response->assertSee($thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_see_threads_single_page(){
        //with
        $thread = factory('App\Thread')->create();
        //when
        $response = $this->get('/threads/'.$thread->id);
        //then
        $response->assertStatus(200);
        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }

}
