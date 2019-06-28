<?php

namespace App\Http\Controllers;

use App\Thread;

class RepliesController extends Controller {

    /**
     * @param $threadChannelSlug
     * @param $threadId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function store($threadChannelSlug, $threadId) {
//        $threadId = $request['id'];
//        $threadChannelSlug = $request['channel_slug'];
        $this->validate(request(), ['body' => 'required']);

        $body = request('body');

        if ($threadId != null && $body != null) {
            $thread = Thread::find($threadId);

            $thread->addReply([
                'body' => $body,
                'user_id' => auth()->id()
            ]);
            return redirect(route('threads.show', ['channel_slug' => $threadChannelSlug, 'id' => $threadId]));
//            return back();
        }
        return back();
    }
}
