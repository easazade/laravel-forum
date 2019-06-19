<?php

namespace Tests\Unit;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use PHPUnit\Framework\Assert;

class ThreadUnitTest extends TestCase {

    use DatabaseMigrations;

    private $user;
    private $thread;
    private $reply;

    protected function setUp(): void {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->thread = factory(Thread::class)->create(['user_id' => $this->user->id]);
        $this->reply = factory(Reply::class)->create(['thread_id' => $this->thread->id]);
    }

    /**
     * @test
     */
    public function should_get_replies_as_collection() {
        Assert::assertInstanceOf(Collection::class, $this->thread->replies);
        Assert::assertNotEmpty($this->thread->replies);
    }

    /**
     * @test
     */

    public function should_get_owner_user() {
        $owner = $this->thread->owner;
        Assert::assertNotNull($owner);
        Assert::assertInstanceOf(User::class, $owner);
    }

    /**
     * @test
     */
    public function a_thread_can_add_reply() {
        //when
        $this->signIn($this->user);
        $currentReplies = $this->thread->replies;
        $this->thread->addReply([
            'user_id' => $this->user->id,
            'body' => "this is my reply"
        ]);
        //then
        $this->thread->refresh();
        $this->assertCount(sizeof($currentReplies) + 1, $this->thread->replies);
//        echo print_r(Reply::all());
//        echo print_r($this->thread->replies);
//        $this->assertCount(2, Reply::all());
    }

}
