<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RepliesController extends Controller {

    function store(Request $request) {
        $threadId = $request['id'];
        $body = $request['body'];

        if ($threadId != null && $body != null) {
            $thread = Thread::find($threadId);

            $thread->addReply([
                'body' => $body,
                'user_id' => auth()->id()
            ]);
            return redirect(route('threads.show', ['id' => $threadId]));
            //        return back();
        }
        return back();
    }
}
