<?php

namespace Tests\Feature;

use App\Channel;
use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadsTest extends TestCase {

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
        $response =
        $response = $this->get(route('threads.show',
            ['channel_slug' => $this->thread->channel->slug,'id' => $this->thread->id]));
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
        $response = $this->get(route('threads.show',
            ['channel_slug' => $this->thread->channel->slug,'id' => $this->thread->id]));
        //then
        $response->assertStatus(200);
        $response->assertSee($reply->body);
        $response->assertSee($reply->owner->name);
    }

    /**
     * @test
     */
    function a_user_can_read_a_thread_according_to_its_tag() {
        $channel = create(Channel::class);
        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadNotInChannel = create(Thread::class);

        $this->get("threads/{$channel->slug}")
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);


    }

}
