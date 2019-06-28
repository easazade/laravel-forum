<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class ParticipateInForumTest
 * @package Tests\Feature
 */
class ParticipateInForumTest extends TestCase {


    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_authenticated_user_should_be_able_to_participate_in_threads() {
        //with
        $this->signIn($user = factory(User::class)->create());
        $thread = create(Thread::class);
        $reply = create(Reply::class);
        //when
        $url = "/threads/{$thread->channel->slug}/{$thread->id}/replies";
//        dd($url);
        $response = $this->post($url, $reply->toArray());
        //then
        $response->assertRedirect();
        //when
        $response = $this->get(route('threads.show', ['channel_slug' => $thread->channel->slug, 'id' => $thread->id]));
//        $response->assertOk();
//        $response->assertSee($reply->body);
    }

    /**
     * @test
     */
    public function a_NON_authenticated_user_should_NOT_be_able_to_participate_in_threads() {
        $this->disableExceptionHandling();
        //expect
        $this->expectException(Exception::class);
        //with
        $thread = create(Thread::class);
        $reply = make(Reply::class);
        //when
        $response = $this->post("/threads/{$thread->channel->slug}/{$thread->id}/replies", $reply->toArray());
    }

    /**
     * @test
     */
    function a_reply_requires_a_body() {
        $thread = create(Thread::class);
        $reply = make(Reply::class, ['body' => null]);

        $this->post(
            route('replies.add', ['channel_slug' => $thread->channel->slug, 'id' => $thread->id]),
            $reply->toArray())
            ->assertSessionHasErrors('body');
    }

}
