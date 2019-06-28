<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reply;

class Thread extends Model {

    protected $guarded = [];

    function replies() {
        return $this->hasMany(Reply::class);
    }

    function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }

    function channel() {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    function addReply($params) {
//        $reply = new Reply([
//            'thread_id' => $this->id,
//            'user_id' => $params['user_id'],
//            'body' => $params['body'],
//        ]);
//        $reply->save();
        $this->replies()->create($params);
    }

    function path() {
        return route('threads.show', ['channel_slug' => $this->channel->slug, 'id' => $this->id], false);
    }

}
