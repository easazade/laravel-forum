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
        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make();
        //when
        $response = $this->post('/threads/' . $thread->id . '/replies', $reply->toArray());
        //then
        $response->assertRedirect();
        //when
        $response = $this->get('/threads/' . $thread->id);
        $response->assertOk();
        $response->assertSee($reply->body);
    }

    /**
     * @test
     */
    public function a_NON_authenticated_user_should_NOT_be_able_to_participate_in_threads() {
        //expect
        $this->expectException(Exception::class);
        //with
        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make();
        //when
        $response = $this->post('/threads/' . $thread->id . '/replies', $reply->toArray());
    }

}
