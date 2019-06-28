@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="#">{{$thread->owner->name}}</a> posted :
                    </div>

                    <div class="card-body">
                        <article>
                            <h1>{{ $thread->title }}</h1>
                            <div class="body">{{ $thread->body }}</div>
                        </article>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 style="color: mediumvioletred;"> replies : </h3>
                @foreach($thread->replies as $reply)
                    @include('thread.reply')
                @endforeach
            </div>
        </div>

        @if(auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8 col-md-offset-2">
                    <form method="post" action="{{route('replies.add',['channel_slug'=>$thread->channel->slug,'id' => $thread->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="body">Body:</label>
                            <textarea name="body" id="body" class="form-control" placeholder="have something to say"
                                      rows="5"></textarea>
                            <br>
                            <button type="submit" class="btn btn-default">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                Please <a href="{{ route('login') }}">&nbsp;sign&nbsp;</a> in to reply on this thread
            </div>
        @endif

    </div>
@endsection
