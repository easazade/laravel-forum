<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadsController extends Controller {

    public function __construct() {
        $this->middleware('auth')->only('store');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $threads = Thread::latest()->get();
        return view('thread.index')->with('threads', $threads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $thread = new Thread([
            'user_id' => auth()->id(),
            'title' => $request['title'],
            'body' => $request['body']
        ]);
        $thread->save();
        return redirect($thread->path());
    }

    public function show($id) {
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
