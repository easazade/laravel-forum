<?php


namespace Tests\Unit;


use App\Channel;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ChannelUnitTest extends TestCase {

    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_channel_consists_of_threads() {
        $channel = create(Channel::class);
        $thread = create(Thread::class, ['channel_id' => $channel->id]);
        //assert
        $this::assertTrue($channel->threads->contains($thread));

    }

}
