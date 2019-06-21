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
        $reply = make(Reply::class);
        //when
        $response = $this->post('/threads/' . $thread->id . '/replies', $reply->toArray());
        //then
        $response->assertRedirect();
        //when
        $response = $this->get(route('threads.show',['id' => $thread->id]));
//        $response->assertOk();
//        $response->assertSee($reply->body);
    }

    /**
     * @test
     */
    public function a_NON_authenticated_user_should_NOT_be_able_to_participate_in_threads() {
        //expect
        $this->expectException(Exception::class);
        //with
        $thread = create(Thread::class);
        $reply = make(Reply::class);
        //when
        $response = $this->post('/threads/' . $thread->id . '/replies', $reply->toArray());
    }

}
