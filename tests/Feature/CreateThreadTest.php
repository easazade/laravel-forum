<?php

namespace Tests\Feature;

use App\Thread;
use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadTest extends TestCase {
    use DatabaseMigrations;

    /**
     * @test
     */
    function an_authenticated_user_can_create_new_forum_threads() {
        //given we have a signed in user
        $this->disableExceptionHandling();
        $this->signIn();
        //when user hit endpoint to create a new user
        $newThread = make(Thread::class);
        $response = $this->post(route('threads.store'), $newThread->toArray());
        //and then we get the location that we have redirected to
        $location = $response->headers->get('Location');
        print_r($location);
        $this->get($location)
            ->assertSee($newThread->title)
            ->assertSee($newThread->body);

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

    /**
     * @test
     */
    function a_thread_requires_a_title() {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    function a_thread_requires_a_body() {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /**
     * @test
     */
    function a_thread_requires_a_channel_id() {
        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');
    }

    /**
     * @test
     */
    function a_thread_requires_a_channel_id_that_exists() {
        $this->publishThread(['channel_id' => 9999])
            ->assertSessionHasErrors('channel_id');
    }

    private function publishThread($theadArgs = []) {
        $this->signIn();

        $thread = make(Thread::class, $theadArgs);

        return $this->post(route('threads.store', $thread->toArray()));
    }


}
