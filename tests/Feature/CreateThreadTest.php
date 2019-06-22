<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Exception;

class CreateThreadTest extends TestCase {
    use DatabaseMigrations;

    /**
     * @test
     */
    function an_authenticated_user_can_create_new_forum_threads() {
        //given we have a signed in user
        $this->signIn();
        //when user hit endpoint to create a new user
        $newThread = make(Thread::class);
        $statusCode = $this->post(route('threads.store'), $newThread->toArray())->status();
        $this->assertTrue($statusCode > 200 && $statusCode < 400);
        //and then we visit our thread page (assert) we should see the new thread
        $response = $this->get(route('threads.show', ['id' => $newThread['id']]));
        $response->assertOk()
            ->assertSee($newThread['title'])
            ->assertSee($newThread['body']);

    }

    /**
     * @test
     */
    function guests_may_not_create_a_thread() {
        $this->expectException(Exception::class);
        //when user hit endpoint to create a new user
        $newThread = make(Thread::class);
        $this->post(route('threads'), $newThread->toArray());
    }

    /**
     * @test
     */
    function guests_cannot_see_create_thread_page() {
        $this->get(route('threads.create'))
            ->assertRedirect(route('login'));
    }


}
