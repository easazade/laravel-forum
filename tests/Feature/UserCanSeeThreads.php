<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserCanSeeThreads extends TestCase {

    use DatabaseMigrations;

    private $thread;

    public function setUp(): void {
        parent::setUp();
        $this->thread = create(Thread::class);
    }


    /**
     * @test
     */
    public function a_user_can_browse_threads() {
        //when
        $response = $this->get('/threads');
        //then
        $response->assertStatus(200);
        $response->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_see_threads_single_page() {
        //when
        $response = $this->get('/threads/' . $this->thread->id);
        //then
        $response->assertStatus(200);
        $response->assertSee($this->thread->title);
        $response->assertSee($this->thread->body);
    }

    /**
     * @test
     */
    public function a_user_can_see_replies_associated_with_a_thread() {
        //with
        $reply = create(Reply::class, ['thread_id' => $this->thread->id]);
        //when
        $response = $this->get('/threads/' . $this->thread->id);
        //then
        $response->assertStatus(200);
        $response->assertSee($reply->body);
        $response->assertSee($reply->owner->name);
    }

}
