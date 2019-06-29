<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ThreadsController extends Controller {

    public function __construct() {
        $this->middleware('auth')->except('index', 'show');
    }


    /**
     * Display a listing of the resource.
     * @param null $channel_slug
     * @return \Illuminate\Http\Response
     */
    public function index($channel_slug = null) {

        if ($channel_slug != null) {
            $channel = Channel::where('slug', $channel_slug)->first();
            if ($channel->exists)
                $threads = Thread::where('channel_id', $channel->id)->latest();
            else
                $threads = Thread::latest();
        } else
            $threads = Thread::latest();

        $byUser = request('by');
        if ($byUser != null){
            $user = User::where('name',$byUser)->firstOrFail();
            $threads = $threads->where('user_id',$user->id);
        }

        $threads = $threads->get();

        return view('thread.index')->with('threads', $threads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('thread.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $thread = new Thread([
            'user_id' => auth()->id(),
            'channel_id' => $request['channel_id'],
            'title' => $request['title'],
            'body' => $request['body']
        ]);
        $thread->save();
        return redirect($thread->path());
    }

    public function show($channel_id, $id) {
        $thread = Thread::find($id);
        return view('thread.single')->with('thread', $thread);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return void
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return void
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     */
    public function destroy($id) {
        //
    }
}
